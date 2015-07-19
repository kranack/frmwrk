<?php

class Connections {


  private $__db = null;

  public function __construct ($db) {
    try {
      $this->_assign($db);
    } catch (InvalidDatabaseException $e) {
      print_r($e->getMessage());
    }
  }

  private function _assign ($db) {
    if (get_class($db) === 'Database') {
      $this->__db = $db;
    } else {
      throw new InvalidDatabaseException;
    }

  }

  public function connect () {
    var_dump($this);
    $this->__db->connect();
  }

}
