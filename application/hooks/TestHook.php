<?php

class TestHook extends Hooks {

  public function system_init () {
    parent::system_init();
    var_dump ('Test Hook system_init function');
  }

}
