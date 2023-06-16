<?php
namespace Alkodesign\Optimizer;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

class File extends Entity\DataManager
{
	public static $IMAGE_EXTENSION = array("png", "jpg", "jpeg");
	
	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
				'title' => Loc::getMessage('IMAGE_ENTITY_ID_FIELD'),
			),
			'IMAGE_NAME' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateImageName'),
				'title' => Loc::getMessage('IMAGE_ENTITY_IMAGE_NAME_FIELD'),
			),
			'IMAGE_SRC' => array(
				'data_type' => 'text',
				'title' => Loc::getMessage('IMAGE_ENTITY_IMAGE_SRC_FIELD'),
			),
			'IMAGE_SIZE' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('IMAGE_ENTITY_IMAGE_SIZE_FIELD'),
			),
			'IMAGE_NEW_SIZE' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('IMAGE_ENTITY_IMAGE_NEW_SIZE_FIELD'),
			),
		);
	}
	/**
	 * Returns validators for IMAGE_NAME field.
	 *
	 * @return array
	 */
	public static function validateImageName()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
	public static function FindPathInPath($PATH = ""){
		if (strlen($PATH) <= 0){
			$PATH = $_SERVER["DOCUMENT_ROOT"];
		}
		
	}
	public static function inBitrix($path){
		$DOCUMENT_ROOT = trim($_SERVER["DOCUMENT_ROOT"], "/");
		$DOCUMENT_ROOT = "/".$DOCUMENT_ROOT;
		if (strpos($path, $DOCUMENT_ROOT . "/bitrix/") !== false){
			if (strpos($path, "bitrix/templates") === false && strpos($path, "bitrix/components") === false){
				return true;
			}
		}
		return false;
	}
	
	public static function FindImageInPath($PATH, $OPEN, &$arResult){
		if (self::inBitrix($PATH))
			return $arResult;
		
		if (strlen($PATH) <= 0){
			$PATH = $_SERVER["DOCUMENT_ROOT"];
		}
		
		if ($handle = opendir($PATH)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$file = $PATH.DIRECTORY_SEPARATOR.$entry;
					if (is_dir($file) && $OPEN == "N"){
						self::FindImageInPath($file, $OPEN, $arResult);
					} else {
						$arInfo = pathinfo($file);
						if (in_array(strtolower($arInfo["extension"]), self::$IMAGE_EXTENSION) && !in_array($file, $arResult)){
							$arResult[] = $file;
						}
					}
				}
			}
			closedir($handle);
		}
		return $arResult;
	}
	
	public static function Optimize($HOST, $PATH, $FILE_NAME, $JPEG_QUALITY = 85){
		$PATH = str_replace($_SERVER["DOCUMENT_ROOT"], "", $PATH);
		
		$PATH .= "/";
		$arPost = array(
			"host" => $HOST,
			"path" => $PATH,
			"file" => $FILE_NAME,
			"JPEG_QUALITY" => $JPEG_QUALITY
		);
		if (function_exists('curl_init')){
			if($curl = curl_init()){
				curl_setopt($curl, CURLOPT_URL, 'http://188.225.34.116/test_optimization/index.php');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_TIMEOUT, 1);
				
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arPost));
				$out = curl_exec($curl);
				curl_close($curl);
			}
		} else {
			$sURL = 'http://188.225.34.116/test_optimization/index.php';
			$sPD = http_build_query($arPost);
			
			$aHTTP = array(
				'http' => array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $sPD
				)
			);
			$context = stream_context_create($aHTTP);
			$out = file_get_contents($sURL, false, $context);
		}
		$arResult = array(
			"STATUS" => "done"
		);
		return json_encode($arResult);
	}
	
	public static function waitOptimizeResult($HOST, $PATH, $FILE_NAME){
		
		$PATH = str_replace($_SERVER["DOCUMENT_ROOT"], "", $PATH);
		
		$arResult = array("STATUS" => "progress", "HOST" => $HOST, "PATH" => $PATH, "FILE_NAME" => $FILE_NAME);
		if (function_exists('curl_init')){
			if($curl = curl_init()){
				curl_setopt($curl, CURLOPT_URL, 'http://188.225.34.116/test_optimization/result_'.md5($HOST));
				
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_TIMEOUT, 1);
				$out = curl_exec($curl);
				
				curl_close($curl);
			}
		} else {
			$sURL = 'http://188.225.34.116/test_optimization/result_'.md5($HOST);
			$out = file_get_contents($sURL);
		}
		
		$arr = json_decode($out, true);
		
		$PATH = trim($PATH, "/");
		$arr["FILE_PATH"] = trim($arr["FILE_PATH"], "/");
		
		if ($arr["FILE_PATH"] == $PATH && $arr["FILE_NAME"] == $FILE_NAME){
			return $out;
		} elseif (isset($arr["FILE_PATH"]) && isset($arr["FILE_NAME"]) && ($arr["FILE_PATH"] != $PATH || $arr["FILE_NAME"] != $FILE_NAME)){
			$arResult = array("STATUS" => "error", "HOST" => $HOST, "PATH" => $PATH, "FILE_NAME" => $FILE_NAME);
		}
		return json_encode($arResult);
	}
	
	public static function DeleteTmpFile($PATH, $FILE_NAME){
		$arPost = array(
			"DELETE" => "Y",
			"PATH" => $PATH,
			"FILE" => $FILE_NAME
		);
		if (function_exists('curl_init')){
			if($curl = curl_init()){
				curl_setopt($curl, CURLOPT_URL, 'http://188.225.34.116/test_optimization/index.php');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arPost));
				$out = curl_exec($curl);
				$result = $out;
				curl_close($curl);
			}
		} else {
			$sURL = 'http://188.225.34.116/test_optimization/index.php';
			$sPD = http_build_query($arPost);
			$aHTTP = array(
				'http' => array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $sPD
				)
			);
			$context = stream_context_create($aHTTP);
			$out = file_get_contents($sURL, false, $context);
			$result = $out;
		}
	}
	
	public static function getImageList(){
		global $DB;
		$sql = "select * from `artrix_image` order by `IMAGE_SRC`";
		$res = $DB->Query($sql, false, $err_mess.__LINE__);
		while ($arImage = $res->Fetch()){
			return $arImage;
		}
	}
	
	public static function findSubsections($path = ""){
		if (strlen($path) <= 0){
			$path = $_SERVER["DOCUMENT_ROOT"];
		}
		$path = trim($path, "/");
		$path = "/" . $path;
		$imageCount = 0;
		if (self::inBitrix($path))
        {
			return array(array(), $imageCount);
        }
		$arResult = array();
		if ($handle = opendir($path)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && !self::inBitrix($path)) {
					$file = $path.DIRECTORY_SEPARATOR.$entry;
					if (is_dir($file)){
						$arResult[$file] = $entry;
					}
                    elseif(is_file($file))
                    {
                      $arr = explode('.', $file);
                      $extension = strtolower(array_pop($arr));
                      if(in_array($extension, static::$IMAGE_EXTENSION))
                      {
                        $imageCount++;
                      }
                    }
				}
			}
			closedir($handle);
		}
		asort($arResult);
		return array($arResult, $imageCount);
	}
    
    /**
     * список директорий, в которых есть картинки
     * @return Array
     */
    public static function getDirList()
    {
      $root = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : 'root';
      $DOCUMENT_ROOT = trim($_SERVER["DOCUMENT_ROOT"], "/");
      $DOCUMENT_ROOT = "/".$DOCUMENT_ROOT;
      list($subdir, $imageCount) = static::getSubDirList($DOCUMENT_ROOT);
      return $dirList = array(
          'title' => $root."({$imageCount})", 
          'value' => $DOCUMENT_ROOT,
          'children' => $subdir,
          'imageCount' => $imageCount
      );
    }
    
    /**
     * список директорий в $dir и поддиректорий
     * Работает рекурсивно
     * @param string $dir абсолютный путь директории
     * @return array
     */
    protected static function getSubDirList($dir)
    {
      $subDirList = array();
      $subdir = array();
      $imageCount = 0;
      list($arSiteSections, $imageCount) = static::findSubsections($dir);
      if(!$arSiteSections)
      {
        return array($subDirList, $imageCount);
      }
      foreach($arSiteSections as $path => $entry)
      {
        $subImageCount = 0;
        list($subdir, $subImageCount) = static::getSubDirList($path);
        if($subImageCount == 0)
        {
          continue;
        }
        $imageCount = $imageCount + $subImageCount;
        $subDirList[] = array(
            'title' => $entry."({$subImageCount})", 
            'value' => $path,
            'children' => $subdir,
            'imageCount' => $imageCount
        );
      }
      return array($subDirList, $imageCount);
    }
	
}