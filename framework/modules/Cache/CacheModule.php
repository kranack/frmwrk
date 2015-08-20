<?php

namespace Modules\Cache;

class CacheModule extends \Module {
  private static $__path = null;
  private static $cache = null;

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

    if (self::$cache === null) {
      if (!\Core::is_loaded("Modules\Cache\Cache")) {
        \Core::require_file(__DIR__, 'Cache.php');
      }
      self::$cache = new Cache(self::$__path);
    }

    \Log::record(__FILE__, "Cache module is enable");
  }

  public static function save ($content) {
    if (!self::is_enabled()) {
      return null;
    }
    self::$cache->save(\Tools::uri(), $content);
  }

  public static function is_cached () {
    if (!self::is_enabled()) {
      return null;
    }
    return self::$cache->check(\Tools::uri());
  }

  public static function dump () {
    $r = self::$cache->restore(\Tools::uri());
    if ($r !== null) {
      echo $r;
    }
  }

}
