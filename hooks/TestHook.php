<?php

class SystemHook implements Hooks {

  public function info () {

    print_r ('Test Hook');

  }

  public function system_init () {

    print_r ('Test Hook init');

  }

}
