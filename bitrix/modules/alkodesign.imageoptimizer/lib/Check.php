<?php
namespace Alkodesign\Optimizer;

use Bitrix\Main\Config\Option;

class Check
{
  CONST MODULE_NAME = "alkodesign.imageoptimizer";
  
  public static function isPNGOptim() {
      $path = Option::get(self::MODULE_NAME,'path_to_optipng', '/usr/bin');
      exec($path.'/optipng -v',$s);
      return ($s?true:false);
  }

  public static function isJPEGOptim() {
      $path = Option::get(self::MODULE_NAME,'path_to_jpegoptim', '/usr/bin');
      exec($path.'/jpegoptim --version',$s);
      return ($s?true:false);
  }

  public static function isRead($path) {
      return is_readable($path);
  }

  public static function isWrite($path) {
      return is_writable($path);
  }
}