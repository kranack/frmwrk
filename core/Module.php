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

  public static function system_init () {
    Log::record(__FILE__, 'system_init called');
    self::$_config[self::_get_classname()] = Loader::get_config(self::_get_classname(), true);
  }

  public static function is_enabled () {
    return (Loader::get_config(self::_get_classname())['status'] === "enable") ? true : false;
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

  private static function _get_classname () {
    $c = explode("\\",get_called_class());
    $classname = $c[count($c)-1];
    return str_replace('Module', '',$classname);
  }
}
