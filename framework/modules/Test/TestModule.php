<?php

namespace Modules\Test;


/* TODO: Check why FormModule is loaded before Form class */
class TestModule extends \Module {
  private static $__form = null;

  public static function system_init () {
    parent::system_init();
    if (!self::is_enabled()) {
      return null;
    }
    \Log::record(__FILE__, "Test module is enable");
  }

}
