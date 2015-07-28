<?php

  namespace Modules\Forms;

class Label extends Element {

  private $_text;

  public function __construct ($text, $name, $id = null, $class = null) {
    parent::__construct ($name, $id, $class);

    $this->_text = $text;
  }

  public function placeholder ($placeholder) {}

  public function display () {
    return $this->render();
  }

  protected function render () {
    ob_start();
    require ($this->__template_path . 'label.tpl');
    return ob_get_clean();
  }

}
