<?php

  namespace Modules\Forms;


/* TODO: Check why FormModule is loaded before Form class */
class FormModule implements \Module {

  private static $__enabled = false;

  public static function info () {
    return "Form module created by Kranack";
  }

  public static function system_init () {
    if (!\Core::is_loaded("Modules\Forms\Form")) {
      //\Log::record(__FILE__, "Form module not loaded");
    }
    self::$__enabled = true;
    $path = __DIR__ . DIRECTORY_SEPARATOR;
    \Core::require_file($path . 'class', 'Element.php');
  }

  public static function enable () {
    self::$__enabled = true;
    var_dump ('Form Module enabled');
  }

  public static function disable () {
    self::$__enabled = false;
    var_dump ('Form Module disabled');
  }

}
