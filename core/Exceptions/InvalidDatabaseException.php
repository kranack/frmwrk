<?php

class InvalidDatabaseException extends Exception {

  public function __construct($name, $db) {
    $class = get_class($db);
    parent::__construct("$name is not a Database ($class)");
    Headers::save(Headers::set_response('500'));
  }

}
