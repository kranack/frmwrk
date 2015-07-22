<?php

class HeaderTypeException extends Exception {

  public function __construct() {
    parent::__construct("Headers Type incorrect");
    Headers::save(Headers::set_response('500'));
  }

}
