<?php

class Controller {

  protected $__resp = null;
  protected $__view = null;
  protected $__model = null;


  public function __construct () {
    $this->__view = new View();
  }

  protected function attach_model ($model) {
    $this->__model = new $model();
  }

}
