<?php

class Config {

  const DEFAULT_CONF = DEFAULT_CONF_FILE;
  private static $__conf = array();

  public static function load ($conf_file = null) {
    if ($conf_file == null) {
      self::_load_conf(self::DEFAULT_CONF);
    } else {
      self::_load_conf($conf_file);
    }
    //var_dump(self::$__conf);
  }

  public static function load_modules ($bool = true) {
    Core::enable(MODULES_DIRECTORY);
  }

  public static function get_hooks ($load_before_core = true) {
    if (empty(self::$__conf['hooks'])) {
      return null;
    }

    if ($load_before_core &&
      isset(self::$__conf['hooks']['pre_hooks'])) {
      return self::$__conf['hooks']['pre_hooks'];
    } else if ((!$load_before_core) &&
      isset(self::$__conf['hooks']['post_hooks'])) {
      return self::$__conf['hooks']['post_hooks'];
    } else {
      return null;
    }
  }

  private static function _load_conf ($conf_file) {
    if (!file_exists($conf_file)) {
      return null;
    }
    $config = file_get_contents($conf_file);
    self::__parse_config($config);
  }

  private static function __parse_config ($config) {
    $conf = json_decode($config, true);
    /*var_dump($conf);
    self::$__conf = self::___extract_array_config_content($conf);
    var_dump(self::$__conf);*/
    self::$__conf = $conf[0];
  }

  /* No longer used */
  private static function ___extract_array_config_content ($config , $arr = array()) {
    if (!is_array($config)) {
      return null;
    }
    $keys = array_keys ($config);

    foreach ($keys as $key) {
      if (is_array($config[$key])) {
        $tmp = self::___extract_array_config_content($config[$key], $arr);
        $arr [$key] = $tmp;
      } else {
        $arr [$key] = $config[$key];
      }
    }

    return $arr;
  }

}
