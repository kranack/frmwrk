<?php

  namespace Modules\Forms;

class Input extends Element {

  private $_type;

  public function __construct ($name, $type = "text", $id = null, $class = null) {
    parent::__construct($name, $id, $class);
    $this->_type = $type;
  }

  public function placeholder ($placeholder) {
    $this->_placeholder = $placeholder;

    return $this;
  }

  public function attach ($label) {
    if (get_class($label) !== "Modules\Forms\Label") {
      return null;
    }
    $this->_label = $label;

    return $this;
  }

  public function display () {
    return $this->render();
  }

  protected function render () {
    ob_start();
    require ($this->__template_path . 'input.tpl');
    return ob_get_clean();
  }

}
