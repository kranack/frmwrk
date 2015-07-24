<?php

  namespace Modules\Forms;

class Option {

  private $_obj;

  public function __construct ($text, $value) {
    $this->_obj = new \StdClass();
    $this->_obj->text = $text;
    $this->_obj->value = $value;
  }

  public function get () {
    return $this->_obj;
  }

}
