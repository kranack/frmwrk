<?php

  namespace Modules\Forms;

abstract class Element {

  protected $_name;
  protected $_id;
  protected $_class;
  protected $_placeholder;

  public function __construct ($name, $id, $class) {
    $this->_name = $name;
    $this->_id = $id;
    $this->_class = $class;
    $this->_placeholder = null;

    return $this;
  }

  abstract public function placeholder ($placeholder);

  abstract public function display ();

  abstract protected function render ();

}
