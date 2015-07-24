<?php
/**
 * @file Connections.php
 * @author Damien Calesse
 * @date 23/07/2015
 * @description connections class to handle multiple database connections
 */
class Connections {


  private static $__db = array();

  /**
   * Get function
   * @param name (string) name of the database
   * @return (Database) instance of Database class if an
   *         object is stored with the index $name
   */
  public static function get ($name) {
    if (!array_key_exists($name, self::$__db)) {
      return null;
    }
    return self::$__db[$name];
  }

  /**
   * Add function
   * @param name (string) name of the database
   * @param db (Database) instance of Database class
   */
  public static function add ($name, $db) {
    try {
      self::_assign($name, $db);
    } catch (InvalidDatabaseException $e) {

    }
  }

  /**
   * _Assign function
   * @param name (string) name of the database
   * @param db (Database) instance of Database class
   */
  private static function _assign ($name, $db) {
    if (!is_object($db)) {
      throw new InvalidDatabaseException($name, $db);
    }
    if (get_class($db) === 'Database') {
      self::$__db [$name] = $db;
    } else {
      throw new InvalidDatabaseException($name, get_class($db));
    }
  }

}
