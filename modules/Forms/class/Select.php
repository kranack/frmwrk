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

  protected function render () {
    $render = '<select';
    if ($this->_id != null) {
      $render .= ' id="'. $this->_id .'"';
    }
    if ($this->_class != null) {
      $render .= ' class="'. $this->_class .'"';
    }
    $render .= ' name="'. $this->_name .'" >';

    foreach ($this->_opts as $opt) {
      $o = $opt->get();
      $render .= '<option value="' . $o->value . '">';
      $render .= $o->text . '</option>';
    }

    $render .= '</select>';

    return $render;
  }

}
