<?php

class Connections {


  private static $__db = array();

  public static function get ($name) {
    if (!array_key_exists($name, self::$__db)) {
      return null;
    }
    return self::$__db[$name];
  }

  public static function add ($name, $db) {
    self::_assign($name, $db);
  }

  private static function _assign ($name, $db) {
    if (get_class($db) === 'Database') {
      self::$__db [$name] = $db;
    } else {
      throw new InvalidDatabaseException($name, $db);
    }
  }

}
