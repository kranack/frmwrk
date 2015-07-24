<?php

  namespace Modules\Forms;

/* TODO: Move html to template */
class Form {

  private $_objs = array();

  public function __construct ($type, $action) {
    $this->_type = $type;
    $this->_action = $action;

    return $this;
  }

  public function add_obj ($obj) {
    $classname = get_class($obj);

    if (!isset($this->_objs[strtolower($classname)])) {
      $this->_objs [strtolower($classname)] = array();
    }
    $this->_objs [strtolower($classname)][] = $obj;

    return $this;
  }

  public function add ($input, $name, $type = "text", $id = null, $class = null) {
    $classname = ucfirst($input);
    if (!Core::is_loaded($classname)) {
      return null;
    }

    if (!isset($this->_objs[$input])) {
      $this->_objs [$input] = array();
    }
    $this->_objs [$input][] = new $classname($name, $type, $id, $class);

    return $this;
  }

  public function display () {
    return $this->render();
  }

  private function render () {
    $render = '<form type="' . $this->_type . '" action="' . $this->_action . '">';

    foreach ($this->_objs as $type) {
      foreach ($type as $t) {
        $render .= $t->display();
      }
    }

    $render .= '</form>';

    return $render;
  }

}
