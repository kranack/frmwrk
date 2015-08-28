<?php

class InvalidDatabaseException extends Exception {

  public function __construct($name, $class) {
    parent::__construct("$name is not a Database ($class)");
    Headers::save(Headers::set_response('500'));
    $this->display_error_page();
  }

  private function display_error_page () {
    $c = new HTTPErrorsController();
    $c->_500();
  }

}
