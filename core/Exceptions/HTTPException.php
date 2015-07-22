<?php

class HTTPException extends Exception {

  private $_path;
  private $_method;
  private $_error;

  private $_err_message;
  private $_resp_message;

  public function __construct($path, $method, $error) {
    $this->_path = $path;
    $this->_method = $method;
    $this->_error = $error;
    $this->_err_message = Headers::set_response($error);
    $this->_resp_message = Headers::get_response($error);

    parent::__construct($error);
    Headers::save ($this->_err_message);
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
    return $this->_err_message;
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
