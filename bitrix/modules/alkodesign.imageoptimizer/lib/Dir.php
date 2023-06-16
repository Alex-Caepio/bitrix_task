<?php
namespace Alkodesign\Optimizer;

class Dir
{  
  /**
   * возвращает список изображений во всез поддиректориях
   * @param type $path
   * @return array
   */
  public function getFiles($path)
  {
    $imageList = array();
    if (strlen($path) <= 0)
    {
      $path = $_SERVER["DOCUMENT_ROOT"];
    }
    $path = trim($path, "/");
    $path = "/" . $path;
    if (File::inBitrix($path))
    {
      return $imageList;
    }
    if ($handle = opendir($path)) {
      while (false !== ($entry = readdir($handle))) {
          if ($entry != "." && $entry != ".." && !File::inBitrix($path)) {
              $file = $path.DIRECTORY_SEPARATOR.$entry;
              if (is_dir($file)){
                  $imageList = array_merge($imageList, $this->getFiles($file));
              }
              elseif(is_file($file))
              {
                $arr = explode('.', $file);
                $extension = strtolower(array_pop($arr));
                if(in_array($extension, File::$IMAGE_EXTENSION))
                {
                  $imageList[] = $file;
                }
              }
          }
      }
      closedir($handle);
    }
    return $imageList;
  }
  
  /**
   * поиск файлов в директориях $dirList
   * @param array $dirList
   * @return array
   */
  public function searchFiles($dirList)
  {
    $files = array();
    foreach($dirList as $dir)
    {
      $files = array_merge($files, $this->getFiles($dir));
    }
    return array_unique($files);
  }
}