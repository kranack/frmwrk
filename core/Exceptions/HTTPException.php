<?php

class HTTPException extends Exception {

  private $_path;
  private $_method;
  private $_error;

  protected $__errors = array(
    '404' => 'Page Not Found'
  );

  public function __construct($path, $method, $error) {
    $this->_path = $path;
    $this->_method = $method;
    $this->_error = $error;
    parent::__construct("Erreur " . $error . " " . $this->getMessageError());
  }

  function get_path () {
    return $this->_path;
  }

  function get_method () {
    return $this->_method;
  }

  function get_error () {
    return $this->_error;
  }

  function getMessageError() {
    if (array_key_exists($this->__errors[$this->_error])) {
      return $this->__errors[$this->_error];
    }

    return "";
  }

  function set_path ($_path) {
    $this->_path = $_path;
  }

  function set_method ($_method) {
    $this->_method = $_method;
  }

  function set_error ($_error) {
    $this->_error = $_error;
  }

}
