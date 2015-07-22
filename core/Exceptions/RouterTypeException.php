<?php

class RouterTypeException extends Exception {

  public function __construct($type) {
    parent::__construct("$type is not a valid type of route");
    Headers::save(Headers::set_response('500'));
  }

}
