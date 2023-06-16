<?php
namespace Alkodesign\Optimizer;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

IncludeModuleLangFile(__FILE__);
class CompressLocal
{
    private $jpegoptim = false;
    private $pngoptim = false;
    CONST MODULE_ID = 'alkodesign.imageoptimizer';
    public $LAST_ERROR;

    /**
     * Путь до jpegoptim
     * @var string 
     */
    private $jpegOptimPath = '/usr/bin';
    /**
     * Путь до optipng
     * @var string 
     */
    private $pngOptimPath = '/usr/bin';
    /**
     * Качество jpeg-файлов при сжатии - от 5 до 100
     * @var int 
     */
    protected $jpegOptimCompress;
    /**
     * Включить progressive jpeg если значение равно  'Y'
     * @var type 
     */
    protected $jpegProgress = false;
    /**
     * Степень сжатия у png-файлов - от 1 до 7
     * @var int 
     */
    protected $pngOptimCompress;

    private static $instance;

    public function __construct() {
        $this->pngOptimPath = Option::get(self::MODULE_ID,'path_to_optipng');
        $this->jpegOptimPath = Option::get(self::MODULE_ID,'path_to_jpegoptim');
        $this->jpegOptimCompress = Option::get(self::MODULE_ID,'jpegoptim_compress', 80);
        $this->pngOptimCompress = Option::get(self::MODULE_ID,'optipng_compress', 3);
        $this->jpegProgress = (Option::get(self::MODULE_ID,'jpeg_progressive')=='Y');
    }

    /**
     * @static
     * @return Compress
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }
    
    /**
     * 
     * @return bool
     */
    public function hasPngoptim() {
        if(!$this->pngoptim) {
            $output = NULL;
            exec($this->pngOptimPath.'/optipng -v', $output);
            if($output) 
            {
                return $this->pngoptim = true;
            }
        }
        return $this->pngoptim;
    }
    
    /**
     * 
     * @return bool
     */
    public function hasJpegoptim() {
        if(!$this->jpegoptim) {
            $output = NULL;
            exec($this->jpegOptimPath.'/jpegoptim --version', $output);
            if($output) 
            {
                $this->jpegoptim = true;
            }
        }
        return $this->jpegoptim;
    }

    public function compressJPG($strFilePath) {
        $res = false;
        if(!$this->hasJpegoptim()){
            $this->LAST_ERROR = Loc::getMessage('ALKO_IMAGECOMPRESS_NO_MODULE',array('#MODULE#'=>'jpegoptim'));
            return $res;
        }
        if(file_exists($strFilePath)) 
        {
            $strFilePath = strtr(
                $strFilePath,
                array(
                    ' '=>'\ ',
                    '('=>'\(',
                    ')'=>'\)',
                    ']'=>'\]',
                    '['=>'\[',
                )
            );
            $strCommand = '';
            if($this->jpegProgress) 
            {
                $strCommand .= '--all-progressive';
            }
            $strCommand .= ' --strip-all -t';
            if($this->jpegOptimCompress) 
            {
                $strCommand .= " -m{$this->jpegOptimCompress}";
            }
            exec($this->jpegOptimPath."/jpegoptim $strCommand $strFilePath 2>&1", $res);
            $perm = 0775;
            if(defined(BX_FILE_PERMISSIONS))
            {
              $perm = BX_FILE_PERMISSIONS;
            }
            @chmod($strFilePath, $perm);
        }
        return $res;
    }

    public function compressPNG($strFilePath) 
    {
        $res = false;
        if(!$this->hasPngoptim())
        {
            $this->LAST_ERROR = Loc::getMessage('ALKO_IMAGECOMPRESS_NO_MODULE',array('#MODULE#'=>'optipng'));
            return $res;
        }
        if(file_exists($strFilePath)) 
        {
            $strFilePath = strtr(
                $strFilePath,
                array(
                    ' '=>'\ ',
                    '('=>'\(',
                    ')'=>'\)',
                    ']'=>'\]',
                    '['=>'\[',
                )
            );
            exec($this->pngOptimPath."/optipng -strip all -o{$this->pngOptimCompress} $strFilePath 2>&1", $res);
            $perm = 0775;
            if(defined(BX_FILE_PERMISSIONS))
            {
              $perm = BX_FILE_PERMISSIONS;
            }
            @chmod($strFilePath, $perm);
        }
        return $res;
    }
    
    /**
     * оптимизация изображения $filePath
     * @param string $filePath
     * @return mixed
     */
    public function compressFile($filePath)
    {
      if(function_exists('mime_content_type'))
      {
        $contentType = mime_content_type($filePath);
        switch ($contentType) {
          case 'image/jpeg' :
              return $this->compressJPG($filePath);
          case 'image/png' :
              return $this->compressPNG($filePath);
          default :
              $this->LAST_ERROR = Loc::getMessage('ALKO_IMAGECOMPRESS_CONTENT_TYPE',array('#TYPE#' => $contentType));
              return null;
        }
      }
      else
      {
        $arr = explode('.', $filePath);
        $extension = strtolower(array_pop($arr));
        if(in_array(strtolower($extension), array('jpg', 'jpeg')))
        {
          return $this->compressJPG($filePath);
        }
        elseif(in_array(strtolower($extension), array('png')))
        {
          return $this->compressPNG($filePath);
        }
        else
        {
          $this->LAST_ERROR = Loc::getMessage('ALKO_IMAGECOMPRESS_EXTENSION',array('#EXTENSION#' => $extension));
          return null;
        }
      }
    }
}