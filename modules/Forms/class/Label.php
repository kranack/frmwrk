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
    $render = '<label';
    if ($this->_id != null) {
      $render .= ' id="'. $this->_id .'"';
    }
    if ($this->_class != null) {
      $render .= ' class="'. $this->_class .'"';
    }
    $render .= ' for="'. $this->_name .'" >';
    $render .= $this->_text . '</label>';

    return $render;
  }

}
