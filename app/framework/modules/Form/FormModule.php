<?php

  namespace Modules\Form;


/* TODO: Check why FormModule is loaded before Form class */
class FormModule extends \Module {
  private static $__form = null;

  public static function system_init () {
    $path = __DIR__ . DIRECTORY_SEPARATOR;
    \Core::require_file($path . 'class', 'Element.php');
    parent::system_init();
    if (!self::is_enabled()) {
      return null;
    }
    \Log::record(__FILE__, "Form module is enable");
    if (!\Core::is_loaded("Modules\Forms\Form")) {
      //\Log::record(__FILE__, "Form module not loaded");
    }
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
