<?php

class UserController extends Controller {


  public function index ($args) {
    //var_dump(func_get_args());
    print_r($args);
    $user = new UserModel();
    $user->insert(array(
      'uid'      => '',
      'username' => 'kranack',
      'passwd'   => 'shit happens',
      'role'     => 0
    ));
  }

}
