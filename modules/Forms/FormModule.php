<?php

  namespace Modules\Forms;


/* TODO: Check why FormModule is loaded before Form class */
class FormModule implements \Module {

  private static $__enabled = false;
  private static $__form = null;

  public static function info () {
    return "Form module created by Kranack";
  }

  public static function system_init () {
    if (!self::is_enabled()) {
      return null;
    }
    if (!\Core::is_loaded("Modules\Forms\Form")) {
      //\Log::record(__FILE__, "Form module not loaded");
    }
    self::$__enabled = true;
    $path = __DIR__ . DIRECTORY_SEPARATOR;
    \Core::require_file($path . 'class', 'Element.php');
  }

  public static function is_enabled () {
    return self::$__enabled;
  }

  public static function enable () {
    self::$__enabled = true;
    \Log::record(__FILE__, "Form Module enabled");
  }

  public static function disable () {
    self::$__enabled = false;
    \Log::record(__FILE__, "Form Module disabled");
  }

  public static function validation ($form) {
    if (get_class($form) !== "Form") {
      return null;
    }

    self::$__form = $form;
    return self::is_valid();
  }

  private static function is_valid () {
    return self::$__form->check();
  }

}
