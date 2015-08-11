<?php

class UserController extends Controller {


  public function index ($args) {
    //var_dump(func_get_args());
    print_r($args);
    $user = new UserModel();
    $azer = $user->insert(array(
      'username' => 'chipolata',
      'passwd'   => 'shit happens',
      'role'     => 0
    ));
  }

  public function post ($args) {
    print_r($args);
  }

  public function post_json ($args) {
    print_r(json_encode($args));
  }

}
