<?php

  namespace Modules\Forms;

class Input extends Element {

  private $_type;

  public function __construct ($name, $type = "text", $id = null, $class = null) {
    parent::__construct($name, $id, $class);
    $this->_type = $type;

    return $this;
  }

  public function placeholder ($placeholder) {
    $this->_placeholder = $placeholder;

    return $this;
  }

  public function display () {
    return $this->render();
  }

  protected function render () {
    $render = '<input type="'. $this->_type .'"';
    if ($this->_id != null) {
      $render .= ' id="'. $this->_id .'"';
    }
    if ($this->_class != null) {
      $render .= ' class="'. $this->_class .'"';
    }
    if ($this->_placeholder != null) {
      $render .= ' placeholder="'. $this->_placeholder .'"';
    }
    $render .= ' name="'. $this->_name .'" >';

    return $render;
  }

}
