<?php
namespace Alkodesign\Optimizer;

class Actions
{
  /**
   * ��������� ������ ����������� � ����������� $dirlist
   * @param array $dirlist
   * @return string
   */
  public static function getFileList($dirlist)
  {
    $dirObj = new Dir();
    return json_encode($dirObj->searchFiles($dirlist));
  }
  
  /**
   * ����������� ����� $filePath
   * @param string $filePath
   * @return string
   */
  public static function optimizateFile($filePath)
  {
    $helper = new Optimizer();
    if($helper->processFile($filePath))
    {
      return json_encode(array('result' => true));
    }
    else
    {
      return json_encode(array('result' => true, 'error' => $helper->getLastError()));
    }
  }
}