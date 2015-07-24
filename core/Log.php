<?php

class Log {

  private static $_dir = LOG_DIRECTORY;
  private static $_file = DEFAULT_LOG_FILE;

  public static function set ($file) {
    try {
      $path = self::$_dir . DIRECTORY_SEPARATOR . $file;
      self::_set ($path);
    } catch (FileNotFoundException $e) {
      return null;
    }
  }

  public static function record ($file, $log) {
    if ($log === null) {
      return null;
    }
    $path = self::$_dir . DIRECTORY_SEPARATOR . self::$_file;
    self::_write($path, $file, $log);
  }

  public static function dump () {
    $path = self::$_dir . DIRECTORY_SEPARATOR . self::$_file;
    $c = self::_get($path);
    var_dump($c);
  }

  public static function drop () {

  }

  private static function _set ($path) {
    if (!file_exists($path)) {
      throw new FileNotFoundException($path);
    }
    self::$_file = $file;
  }

  private static function _get ($path) {
    return file_get_contents ($path);
  }

  private static function _write ($path, $file, $log) {
    date_default_timezone_set ("Europe/Paris");
    $datetime = date ('d-m-Y H:i:s');
    $line = "[$datetime] : $log ($file) \r\n";
    file_put_contents ($path, $line, FILE_APPEND);
  }
}
