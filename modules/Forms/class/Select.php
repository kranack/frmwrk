<?php

  namespace Modules\Forms;

class Select extends Element {

  private $_opts;

  public function __construct ($name, $opts = array() , $id = null, $class = null) {
    parent::__construct($name, $id, $class);
    $this->_opts = $opts;

    return $this;
  }

  public function add ($option) {
    if (empty((array) $option)) {
      return null;
    }

    $this->_opts [] = $option;
  }

  public function placeholder ($placeholder) {}

  public function display () {
    return $this->render();
  }

  public function check () {
    return false;
  }

  protected function render () {
    ob_start();
    require ($this->__template_path . 'select.tpl');
    return ob_get_clean();
  }

}
