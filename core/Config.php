<?php

class Config {

  const DEFAULT_CONF = DEFAULT_CONF_FILE;

  public static function load ($conf_file = null) {
    if ($conf_file == null) {
      self::_load_conf(self::DEFAULT_CONF);
    } else {
      self::_load_conf($conf_file);
    }
  }

  private static function _load_conf () {
    
  }

}
