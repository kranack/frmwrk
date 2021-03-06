<?php

namespace Modules\Cache;

/**
 *  TODO: Gérer les suppressions de fichiers (supprimer dynamiquement
 *        les fichiers dans datas.json)
 */

class Cache {

  private $__path;
  private $__datas;
  private $__cache;
  private $__excpts = null;

  /**
   * Cache Module class
   * Initialize cache
   * @param (string) $cache_path : path of cache directory
   */
  public function __construct ($cache_path) {
    $this->__path = \Tools::document_root() . $cache_path . DIRECTORY_SEPARATOR;
    $this->__datas = __DIR__ . DIRECTORY_SEPARATOR . 'datas.json';
    $this->__cache = $this->_get_datas();
    if (array_key_exists('exceptions', CacheModule::config()['opts'][0])) {
      $this->__excpts = explode(';', CacheModule::config()['opts'][0]['exceptions']);
    }
  }

  /**
   * Save in cache
   * @param (string) $path : uri path to save
   * @param (string) $content : page content to save
   */
  public function save ($path, $content) {
    if ($this->check($path)
        || $this->check($path) === null) {
      return null;
    }

    if (array_key_exists($path, $this->__cache)) {
      $this->_drop_cache($path);
    }

    $time = time();
    $cachename = md5(uniqid() . $path . $time);

    $this->__cache [$path] = array(
      'file' => $cachename,
      'time' => $time
    );

    $this->_set_datas();
    $this->_record($cachename, $content);
  }

  /**
   * Restore from cache
   * @param (string) $path : uri path to restore
   * @return (string) or (null) : content or null if not stored
   *         or not valid anymore
   */
  public function restore ($path) {
    if ($this->check($path)) {
      return $this->_get($this->__cache[$path]['file']);
    }
    return null;
  }

  /**
   * Check if cache is stored or valid
   * @param (string) $path : path to check
   */
  public function check ($path) {
    if (in_array($path, $this->__excpts)) {
      return null;
    }

    if (array_key_exists($path, $this->__cache)) {
      if (time() <= $this->__cache[$path]['time'] + (30 * 60)) {
        return true;
      }
    }
    return false;
  }

  /**
   * Record content into a file
   * @param (string) $cachename : filename
   * @param (string) $content : file's content
   * @return (string) file_put_contents status
   */
  private function _record ($cachename, $content) {
    return file_put_contents ($this->__path . $cachename, $content);
  }

  /**
   * Get cache content
   * @param (string) $cachename : filename
   * @return (string) file's contents
   */
  private function _get ($cachename) {
    return file_get_contents ($this->__path . $cachename);
  }

  /**
   * Get datas from json file
   * @return (array) content of data's file
   */
  private function _get_datas () {
    return json_decode(file_get_contents($this->__datas), true)[0];
  }

  /**
   * Set datas to json file
   * @return (string) file_put_contents status
   */
  private function _set_datas () {
    return file_put_contents($this->__datas, "[". json_encode($this->__cache, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK) ."]");
  }

  /**
   * Unlink cache file and unset index in cache's array
   * @param (string) $index : valid index to unset
   */
  private function _drop_cache ($index) {
    unlink ($this->__path . $this->__cache[$index]['file']);
    unset ($this->__cache[$index]);
  }

}
