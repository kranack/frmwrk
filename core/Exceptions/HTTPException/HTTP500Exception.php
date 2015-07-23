<?php

class HTTP500Exception extends HTTPException {

  public function __construct($path, $method) {
    $this->_path = $path;
    $this->_method = $method;
    parent::__construct($path, $method, "500");
  }

}
