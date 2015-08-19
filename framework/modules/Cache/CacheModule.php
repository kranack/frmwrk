<?php

namespace Modules\Cache;

class CacheModule extends \Module {
  private static $__path = null;

  public static function system_init () {
    parent::system_init();
    if (!self::is_enabled()) {
      return null;
    }
    $opts = self::config()['opts'];

    foreach($opts as $opt) {
      if (in_array('path', array_keys($opt))) {
        self::$__path = $opt['path'];
      }
    }

    \Log::record(__FILE__, "Cache module is enable");
  }

}
