<?php
namespace Alkodesign\Optimizer;
use Bitrix\Main\Config\Option;
class Optimizer
{
  CONST USE_LOCAL_SERVICE = 'local';
  CONST USE_REMOTE_SERVICE = 'remote';
  CONST MODULE_NAME = "alkodesign.imageoptimizer";
  protected $lastError;

  private
      $enableElement = false,
      $enableSection = false,
      $enableResize = false,
      $enableSave = false;

  private static $instance;
  
  
  public function __construct() 
  {
    $this->enableElement = (Option::get(self::MODULE_NAME,'enable_element')=='Y');
    $this->enableSection = (Option::get(self::MODULE_NAME,'enable_section')=='Y');
    $this->enableResize = (Option::get(self::MODULE_NAME,'enable_resize')=='Y');
    $this->enableSave = (Option::get(self::MODULE_NAME,'enable_save')=='Y');
	$this->iblock_element = explode(',',Option::get(self::MODULE_NAME,'iblocks_elemnt',''));
	$this->iblock_section = explode(',',Option::get(self::MODULE_NAME,'iblocks_sect',''));
  }
  
  /**
   * @static
   * @return Optimizer
   */
  public static function getInstance() 
  {
      if (!isset(self::$instance)) {
          $c = __CLASS__;
          self::$instance = new $c;
      }
      return self::$instance;
  }
  
  /**
   * 
   * @param string $filePath
   * @return boolean
   */
  public function processFile($filePath)
  {
    $compressService = Option::get(self::MODULE_NAME, 'compress_service', self::USE_LOCAL_SERVICE);
    switch($compressService)
    {
      case self::USE_LOCAL_SERVICE:
        return $this->processFileLocal($filePath);
      case self::USE_REMOTE_SERVICE:
        return $this->processFileRemote($filePath);
    }
    return false;
  }
  
  /**
   * оптимизация файла $filePath локально
   * @param string $filePath
   * @return type
   */
  protected function processFileLocal($filePath)
  {
    $helper = new CompressLocal();
    $result = $helper->compressFile($filePath);
    $this->lastError = $helper->LAST_ERROR;
    return $result;
  }
  
  protected function processFileRemote($filePath)
  {
    $helper = new CompressRemote();
    $result = $helper->compressFile($filePath);
    $this->lastError = $helper->LAST_ERROR;
    return $result;
  }
  
  /**
   * текст последней ошибки
   * @return string
   */
  public function getLastError()
  {
    return $this->lastError;
  }
  
  public static function onSectionEvent(&$arFields)
  {
      $instance = self::getInstance();
	  if(!in_array($arFields["IBLOCK_ID"],$instance->iblock_section)) return;
      if($instance->enableSection && $arFields['PICTURE']) 
      {
          $rsSection = \CIBlockSection::GetByID($arFields["ID"]);
          $arSection = $rsSection->GetNext();
          $instance->compressImageByID($arSection['PICTURE']);
      }
  }
  
  public function compressImageByID($intFileID)
  {
      global $DB;
      $res = false;
      if(!$intFileID)
      {
        return $res;
      }
      $arFile  = \CFile::GetByID($intFileID)->GetNext();
      if (!in_array($arFile["CONTENT_TYPE"], array('image/png', 'image/jpeg')))
      {
          return null;
      }
      $strFilePath = $_SERVER["DOCUMENT_ROOT"].\CFile::GetPath($intFileID);
      if(file_exists($strFilePath))
      {
          $oldSize = $arFile["FILE_SIZE"];
          $isCompressed = $this->processFile($strFilePath);
          if($isCompressed) 
          {
              clearstatcache(true,$strFilePath);
              $newSize = filesize($strFilePath);
              if($newSize != $oldSize) 
              {
                  $DB->Query("UPDATE b_file SET FILE_SIZE='".$DB->ForSql($newSize, 255)."' WHERE ID=".(int)$intFileID);
              }
          }
      } else {
      }
      return $res;
    }
    
    public static function onElementEvent(&$arFields)
    {
        $instance = self::getInstance();
        if(!$instance->enableElement) 
        {
          return;
        }
		if(!in_array($arFields["IBLOCK_ID"],$instance->iblock_element)) return;
		
        if((int)$arFields["PREVIEW_PICTURE_ID"] > 0)
        {
            $instance->compressImageByID($arFields["PREVIEW_PICTURE_ID"]);
        }
        if((int)$arFields["DETAIL_PICTURE_ID"] > 0)
        {
            $instance->compressImageByID($arFields["DETAIL_PICTURE_ID"]);
        }
        $elem = false;
        if(!$arFields["PROPERTY_VALUES"]) 
        {
          return;
        }
        foreach ($arFields["PROPERTY_VALUES"] as $key => $values) 
        {
          foreach ($values as  $value) 
          {
            if (!in_array($value['VALUE']['type'], array('image/png', 'image/jpeg')))
            {
              continue;
            }
            if (!$elem) 
            {
                $rsElem = \CIBlockElement::GetByID($arFields["ID"]);
                if ($rsElem 
                        && ($obEl = $rsElem->GetNextElement())) 
                {
                    $elem = $obEl->GetFields();
                    $elem["PROPERTIES"] = $obEl->GetProperties();
                }
            }

            foreach ($elem["PROPERTIES"] as $arProp) 
            {
                if ($arProp["ID"] == $key) 
                {
                    if ($arProp["MULTIPLE"]!='N') 
                    {
                        foreach ($arProp["VALUE"] as $intFileID) 
                        {
                            $instance->compressImageByID($intFileID);
                        }
                    } 
                    else 
                    {
                        $instance->compressImageByID($arProp["VALUE"]);
                    }
                }
            }
          }
        }
    }

    public static function OnFileSave(&$arFile, $strFileName, $strSavePath, $bForceMD5, $bSkipExt)
    {
        $instance = self::getInstance();
        if(!$instance->enableSave)
        {
          return;
        }
        if ((!isset($arFile["MODULE_ID"]) || $arFile["MODULE_ID"] != "iblock"))
        {
            $isCompressed = false;
            switch ($arFile["type"]) 
            {
                case 'image/jpeg' :
                    $isCompressed = $instance->processFile($arFile["tmp_name"]);
                    break;
                case 'image/png' :
                    $isCompressed = $instance->processFile($arFile["tmp_name"]);
                    break;
            }
            if($isCompressed) {
                $arFile["size"] = filesize($arFile["tmp_name"]);
            }
        }
    }

    public static function OnFileDelete($arFile)
    {
      //очитска истории сжатий
    }
    
    public static function onResizeEvent($arFile, $arParams, &$callbackData, &$cacheImageFile, &$cacheImageFileTmp, &$arImageSize) 
    {
        $instance = self::getInstance();
        if(!$instance->enableResize) 
        {
          return;
        }
        if (in_array($arFile["CONTENT_TYPE"], array('image/png', 'image/jpeg')))
        {
            return $instance->processFile($cacheImageFileTmp);
        }
    }
  
  
}