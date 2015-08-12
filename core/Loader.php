<?php

class Loader {

  private static $_current_file = null;

  /***************************************
   * Load a module
   *
   * @param (string) $module
   *
   **************************************/
  public static function enable ($module) {
    $conf_path = MODULES_DIRECTORY . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'config.json';
    return self::_set(self::_parse_conf($conf_path), array('status' => 'enable'));
  }

  public static function disable ($module) {
    $conf_path = MODULES_DIRECTORY . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'config.json';
    return self::_set(self::_parse_conf($conf_path), array('status' => 'disable'));
  }

  public static function get_config ($module, $complete = false) {
    $conf_path = MODULES_DIRECTORY . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'config.json';
    return self::_parse_conf($conf_path, $complete);
  }

  private static function _parse_conf ($conf, $complete) {
    self::$_current_file = $conf;
    $config = file_get_contents($conf);
    $c = json_decode($config, true)[0];
    return ($complete) ? $c : $c['config'];
  }

  private static function _parse_all ($conf) {
    self::$_current_file = $conf;
    $config = file_get_contents($conf);
    return json_decode($config, true)[0];
  }

  private static function _set ($conf, $params = array()) {
    if (empty($params)) {
      return null;
    }

    foreach($params as $k => $v) {
      if (isset($conf[$k])) {
        $conf[$k] = $v;
      }
    }
    return self::_save(self::$_current_file, $conf);
  }

  private static function _save ($conf_file, $conf) {
    if (!is_array($conf)) {
      return null;
    }

    $old = self::_parse_all($conf_file);
    $n = $old;
    $n['config'] = array_merge($old['config'],$conf);
    $r = file_put_contents($conf_file, "[". json_encode($n) ."]");

    self::$_current_file = null;

    return $r;
  }

}
