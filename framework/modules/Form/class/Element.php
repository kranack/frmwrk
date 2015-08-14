<?php

  namespace Modules\Form;

abstract class Element {

  protected $_name;
  protected $_id;
  protected $_class;
  protected $_placeholder;
  protected $__template_path;

  public function __construct ($name, $id, $class) {
    $this->_name = $name;
    $this->_id = $id;
    $this->_class = $class;
    $this->_placeholder = null;
    $this->__template_path = MODULES_DIRECTORY . '/Form/_templates/';
    return $this;
  }

  abstract public function placeholder ($placeholder);

  abstract public function display ();

  abstract public function check ();

  abstract protected function render ();

}