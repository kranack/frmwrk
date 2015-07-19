<?php

class Database {

  private $__env = null;

  public function __construct ($conf = array()) {
    if (empty($conf)) {
      return null;
    }
    $this->__env = (object) $conf;
    $this->build();

    return $this;
  }

  private function build() {

  }

  public function current () {
    return $this;
  }

  public function connect () {
    print_r("connect to db");
  }

  public function import_model ($model_params) {
    print_r($model_params);
  }


}
