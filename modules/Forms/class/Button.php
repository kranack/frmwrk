<?php

  namespace Modules\Forms;

class Button extends Element {

  private $_text;
  private $_type;

  public function __construct ($name, $text, $type = 'submit', $id = null, $class = null) {
    parent::__construct($name, $id, $class);
    $this->_text = $text;
    $this->_type = $type;

    return $this;
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
    require ($this->__template_path . 'button.tpl');
    return ob_get_clean();
  }

}
