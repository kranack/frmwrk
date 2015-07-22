<?php

class HeaderStatusException extends Exception {

  public function __construct() {
    parent::__construct("Headers Status incorrect");
    Headers::save(Headers::set_response('500'));
  }

}
