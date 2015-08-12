<?php

  namespace Modules\Form;

/* TODO: FOR LIE A L'ID PUTAIN DE MERDE T'ES CON OU QUOI?!!! */
class Form {

  private $_objs = array();
  private $__template_path;

  public function __construct ($type, $action) {
    $this->_type = $type;
    $this->_action = $action;
    $this->__template_path = '/modules/Form/_templates/';

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

  public function check () {
    $r = false;
    foreach ($this->_objs as $obj) {
      $r |= $obj->check();
    }

    return $r;
  }

  private function render () {
    ob_start();
    require ($this->__template_path . 'form.tpl');
    return ob_get_clean();
  }

}
