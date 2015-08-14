<?php

class Cache {

  private static $__path = 'cache' . PATH_SEPARATORS;
  private static $__cache = array();

  public static function save ($template, $body, $content) {
    $time = time();
    $index = $template . ',' . $body;
    $cachename = md5(uniqid() . $template . $body . $time);

    self::_record ($cachename, $content);
    self::_record_db (array('filename' => $cachename, 'date' => $time, 'cache_index' => $index));
    self::$__cache [$template . ',' . $body] = array ('file' => $cachename, 'date' => time());
  }

  public static function restore ($template, $body) {
    if (!array_key_exists($template . ',' . $body, self::$__cache)) {
      return null;
    }

    if ((self::$__cache[$template . ',' . $body]['date'] + (30 * 60 * 60)) > time()) {
    return self::_get(self::$__cache[$template . ',' . $body]['file']);
  }

    self::_drop_cache ($template . ',' . $body);
    return null;
  }

  public static function restore_from_db () {
    self::$__cache = self::_get_cache_from_db ();
  }

  private static function _record ($cachename, $content) {
    return file_put_contents (self::$__path . $cachename, $content);
  }

  private static function _record_db ($values) {
    $db = Connections::get('core');
    return $db->insert('core_cache', $values);
  }

  private static function _get ($cachename) {
    return file_get_contents (self::$__path . $cachename);
  }

  private static function _get_cache_from_db () {
    $db = Connections::get('core');
    $caches = $db->fetchAll($db->select('core_cache', array(), "1 ORDER BY date DESC"));
    $r = array();
    foreach ($caches as $cache) {
      $r [$cache->cache_index] = array('file' => $cache->filename, 'date' => $cache->date);
    }
    return $r;
  }

  private static function _drop_cache ($index) {
    unlink (self::$__path . self::$__cache[$index]['file']);
    self::_drop_cache_db ($index);
    unset (self::$__cache[$index]);
  }

  private static function _drop_cache_db ($index) {
    $db = Connections::get('core');
    return $db->delete('cache_core', "cache_index = '$index'");
  }

}
