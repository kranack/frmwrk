<?php

class TestHook implements Hooks {

  public function info () {

    var_dump ('Test Hook info function');

  }

  public function system_init () {

    var_dump ('Test Hook system_init function');

  }

}
