<?php

  namespace Modules\Form;

class Input extends Element {

  private $_type;
  private $_label;

  public function __construct ($name, $type = "text", $id = null, $class = null) {
    parent::__construct($name, $id, $class);
    $this->_type = $type;
    $this->_label = null;
  }

  public function placeholder ($placeholder) {
    $this->_placeholder = $placeholder;

    return $this;
  }

  public function attach ($label) {
    if (get_class($label) !== "Modules\Form\Label") {
      return null;
    }
    $this->_label = $label;

    return $this;
  }

  public function display () {
    return $this->render();
  }

  public function check () {
    return false;
  }

  protected function render () {
    ob_start();
    require ($this->__template_path . 'input.tpl');
    return ob_get_clean();
  }

}
