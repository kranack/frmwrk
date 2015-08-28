<?php

interface Module_Interface {

  public static function infos ();

  public static function system_init ();

}

class Module implements Module_Interface {

  private static $_config = null;

  public static function infos () {
    return self::$_config[self::_get_classname()]['infos'];
  }

  public static function config () {
    return self::$_config[self::_get_classname()]['config'];
  }

  public static function insert ($value = array(), $opt = false) {
    return Loader::insert(self::_get_classname(), $value, $opt);
  }

  public static function edit ($value = array(), $opt = false) {
    return Loader::edit(self::_get_classname(), $value, $opt);
  }

  public static function delete ($key) {
    return Loader::delete(self::_get_classname(), $key);
  }

  public static function system_init () {
    Log::record(__FILE__, 'system_init called');
    self::$_config[self::_get_classname()] = Loader::get_config(self::_get_classname(), true);
    /* Exit if the module is disabled */
    if (!self::is_enabled()) {
      return null;
    }
    /* Require all files needed otherwise */
    self::require_files();
  }

  public static function is_enabled () {
    return (Loader::get_config(self::_get_classname())['status'] === "enable");
  }

  public static function status () {
    return Loader::get_config(self::_get_classname())['status'];
  }

  public static function enable () {
    Log::record(__FILE__, self::_get_classname(). " Module enabled");
    return Loader::enable(self::_get_classname());
  }

  public static function disable () {
    Log::record(__FILE__, self::_get_classname(). " Module disabled");
    return Loader::disable(self::_get_classname());
  }

  public static function require_files () {
    $module = self::_get_classname();
    self::_require_directory(MODULES_DIRECTORY . DIRECTORY_SEPARATOR . $module);
  }

  private static function _get_classname () {
    $c = explode("\\",get_called_class());
    $classname = $c[count($c)-1];
    return str_replace('Module', '',$classname);
  }

  private static function _require_directory ($dir) {
    $_files = self::_get_files_from_dir($dir);
    foreach($_files as $_file) {
      if (is_dir($_file)) {
        self::_require_directory($_file);
      }
      if (!(strpos($_file, ".json") !== false)
          && !(strpos($_file, "_") !== false)) {
            require_once ($_file);
      }
    }
  }

  private static function _get_files_from_dir ($dir) {
    $files = array();

    $dh  = opendir($dir);
    while (false !== ($filename = readdir($dh))) {
      $module_filename = self::_get_classname() . 'Module.php';
      if(!in_array($filename,array(".","..", $module_filename))) {
        if (is_dir($dir . DIRECTORY_SEPARATOR . $filename)) {
          $files = array_merge($files, self::_get_files_from_dir($dir . DIRECTORY_SEPARATOR . $filename));
        } else {
          $files[] = $dir . DIRECTORY_SEPARATOR . $filename;
        }
      }
    }
    asort($files);
    return $files;
  }
}
