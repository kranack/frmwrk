<?php

  namespace Modules\Form;

class TextArea extends Element {

  private $_cols;
  private $_rows;

  public function __construct ($name, $id = null, $class = null) {
    parent::__construct ($name, $id, $class);

    return $this;
  }

  public function size ($cols, $rows = null) {
    if ($rows !== null) {
      $this->_rows = $rows;
    }
    $this->_cols = $cols;

    return $this;
  }

  public function placeholder ($placeholder) {
    $this->_placeholder = $placeholder;

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
    require ($this->__template_path . 'textarea.tpl');
    return ob_get_clean();
  }

}
