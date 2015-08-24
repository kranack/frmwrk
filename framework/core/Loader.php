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
    return self::_set(self::_parse_conf(self::_get_conf_path($module)), array('status' => 'enable'));
  }

  public static function disable ($module) {
    return self::_set(self::_parse_conf(self::_get_conf_path($module)), array('status' => 'disable'));
  }

  public static function insert ($module, $value, $opt =false) {
    if ($opt) {
      return self::_insert_option(self::_parse_conf(self::_get_conf_path($module)), $value);
    }
  }

  public static function edit ($module, $value, $opt = false) {
    if ($opt) {
      return self::_set_opts(self::_parse_conf(self::_get_conf_path($module)), $value, $opt);
    }

    return self::_set(self::_parse_conf(self::_get_conf_path($module)), $value);
  }

  public static function delete ($module, $key) {
    return self::_unset(self::_parse_conf(self::_get_conf_path($module)), $key);
  }

  public static function get_config ($module, $complete = false) {
    return self::_parse_conf(self::_get_conf_path($module), $complete);
  }

  private static function _get_conf_path ($module) {
    return MODULES_DIRECTORY . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'config.json';
  }

  private static function _parse_conf ($conf, $complete = false) {
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

  private static function _insert_option ($conf, $params = array()) {
    if (empty($params)) {
      return null;
    }

    $k = count($conf['opts'][0]);
    foreach ($params as $o => $v) {
      if ($v === "false" || $v === "true") {
        $v = ($v === 'true');
      }
      $conf['opts'][0][$o] = $v;
    }

    return self::_save(self::$_current_file, $conf);
  }

  private static function _set_opts ($conf, $params = array(), $key) {
    if (empty($params)) {
      return null;
    }

    foreach ($conf['opts'] as $k => $opt) {
      if (in_array($key, array_keys($opt))) {
        unset($opt[$key]);
        foreach ($params as $o => $v) {
          if ($v === "false" || $v === "true") {
            $v = ($v === 'true');
          }
          $opt[$o] = $v;
        }
        $conf['opts'][$k] = $opt;
      }
    }
    $conf['opts'] = array_values($conf['opts']);


    return self::_save(self::$_current_file, $conf);
  }

  private static function _unset ($conf, $key = null) {
    if ($key === null) {
      return null;
    }

    $keys = explode(";", $key);

    if ($keys[0] === "opts") {
      foreach ($conf['opts'] as $k => $opt) {
        if (in_array($keys[1], array_keys($opt))) {
          unset($opt[$keys[1]]);
          $conf['opts'][$k] = $opt;
          $conf['opts'] = array_values($conf['opts']);
        }
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
    $r = file_put_contents($conf_file, "[". json_encode($n, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK) ."]");

    self::$_current_file = null;

    return $r;
  }

}
