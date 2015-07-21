<?php
/*******************************************
* Core Class
* @author Damien Calesse
* @date 18/07/2015
* @description core class
*******************************************/
class Core {

  private static $_excpt = array('Exceptions', 'Core');
  private static $_dir = __DIR__;

  private static $__loaded = array();
  private static $__priority = array('core\Exceptions\HTTPException');

  public static function require_all () {
    //self::load_priority_files();
    self::_require_directory(self::$_dir);
  }

  private static function load_priority_files () {
    foreach (self::$__priority as $_file) {

      if (!in_array($_file, self::$__loaded)) {
        var_dump(self::$__loaded);
        self::_require_file($_file);
        self::$__loaded [] = $_file;
      }

    }
  }

  private static function _require_file ($filename) {
    //$_filename = self::$_dir . DIRECTORY_SEPARATOR . $filename;
    if (!in_array($filename, self::$_excpt)) {
      require_once($filename);
    }
    if ($p = get_parent_class($filename)) {
      if (!in_array($p, self::$_excpt)) {
        require_once(self::$_dir . DIRECTORY_SEPARATOR . $p . '.php');
      }
    }
    $classname = preg_replace('/\\.[^.\\s]{3,4}$/', '', strrchr($filename, "\\"));
    if ($interfaces = class_implements($classname)) {
      foreach ($interfaces as $interface) {
        require_once(self::$_dir . DIRECTORY_SEPARATOR . $interface . '.php');
      }
    }
  }

  private static function _require_directory ($dir) {
    $_files = self::_get_files_from_dir(self::$_dir);
    var_dump($_files);
    foreach($_files as $_file) {
      if (!in_array($_file, self::$__loaded)) {
        if (is_dir($_file)) {
          self::_require_directory($_file);
        }
        self::_require_file($_file);
        self::$__loaded [] = $_file;
      }
    }
  }

  private static function _get_files_from_dir ($dir) {
    $files = array();

    $dh  = opendir($dir);
    while (false !== ($filename = readdir($dh))) {
      if(!in_array($filename,array(".",".."))) {
        if (is_dir($dir . DIRECTORY_SEPARATOR . $filename)) {
          $files = array_merge($files,    self::_get_files_from_dir($dir . DIRECTORY_SEPARATOR . $filename));
        } else {
          $files[] = $dir . DIRECTORY_SEPARATOR . $filename;
        }
      }
    }
    asort($files);
    return $files;
  }

  /* not used */
  public static function _load_model ($model) {
    try {
      require_once (MODELS_DIRECTORY . DIRECTORY_SEPARATOR . $model . '.php');
    } catch (Exception $e) {
      print_r($e->getMessage());
    }
  }

}
