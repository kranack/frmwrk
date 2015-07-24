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

  protected function render () {
    $render = '<button type="'. $this->_type .'"';
    if ($this->_id != null) {
      $render .= ' id="'. $this->_id .'"';
    }
    if ($this->_class != null) {
      $render .= ' class="'. $this->_class .'"';
    }
    $render .= ' name="'. $this->_name .'" >';
    $render .= $this->_text . '</button>';

    return $render;
  }

}
