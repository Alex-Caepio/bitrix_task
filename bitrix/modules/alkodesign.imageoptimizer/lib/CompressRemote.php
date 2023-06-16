<?php
namespace Alkodesign\Optimizer;
use Bitrix\Main\Config\Option;

class CompressRemote extends CompressLocal
{
  CONST DEFAULT_SERVICE_ADDR = 'http://optimize.alkodesign.ru/index.php';
  /**
   * 
   * @param string $filePath
   * @return boolean
   */
  public function compressFile($filePath)
  {
    $compressedFile = $this->compressFileRemote($filePath);
    if($compressedFile)
    {
      
    }
    return true;
  }
  
  /**
   * сжатие файла на удалённом сервере
   * @param string $filePath абсолютный путь до файла 
   * @return boolean
   */
  protected function compressFileRemote($filePath)
  {
    $serviceAddr = Option::get(self::MODULE_ID, "remote_service_addr", self::DEFAULT_SERVICE_ADDR);
	if(!$serviceAddr) {
		$serviceAddr = self::DEFAULT_SERVICE_ADDR;
	}
    $ch = curl_init($serviceAddr);
    $contentType = NULL;
    if(function_exists('mime_content_type'))
    {
      $contentType = mime_content_type($filePath);
    }
    else
    {
      $arr = explode('.', $filePath);
      $extension = strtolower(array_pop($arr));
      if(in_array(strtolower($extension), array('jpg', 'jpeg')))
      {
        $contentType = 'image/jpeg';
      }
      elseif(in_array(strtolower($extension), array('png')))
      {
        $contentType = 'image/png';
      }
    }
    $cfile = new \CURLFile($filePath, $contentType, basename($filePath));
    $data = array(
        'file' => $cfile,
        'jpegOptimCompress' => $this->jpegOptimCompress,
        'pngOptimCompress' => $this->pngOptimCompress,
        'jpegProgress' => $this->jpegProgress,
        'key' => Option::get(self::MODULE_ID, "remote_service_key", self::DEFAULT_SERVICE_ADDR),
        'host' => $_SERVER["HTTP_HOST"]
        );
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    if($result && curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200)
    {
      return $this->writeFile($result, $filePath);
    }
    $this->LAST_ERROR = 'Удалённый сервис недоступен. Код: '.curl_getinfo($ch, CURLINFO_HTTP_CODE);
    return false;
  }
  
  /**
   * запись оптимизированного изображения
   * @param string $content содержимое файла
   * @param string $filePath абсолютный путь до файла
   * @return boolean
   */
  protected function writeFile($content, $filePath)
  {
    if(@file_put_contents($filePath, $content))
    {
      return TRUE;
    }
    else
    {
      $this->LAST_ERROR = 'Не удалось записать файл';
    }
    return FALSE;
  }
}