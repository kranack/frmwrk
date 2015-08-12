<?php

interface Hooks_Interface {

  public function infos ();

  public function system_init ();

}

class Hooks implements Hooks_Interface {

  public function infos () {
    var_dump ('Hook info function');
  }

  public function system_init () {
    var_dump('do stuff here');
  }

}
