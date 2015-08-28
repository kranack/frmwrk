<?php

class UserController extends Controller {


  public function index ($args) {
    //var_dump(func_get_args());
    print_r($args);
    $user = new UserModel;
    /*$user->insert('user', array(
      'username' => 'chipolata',
      'passwd'   => 'shit happens',
      'role'     => 0
    ));*/
    $user->select('uid');
    var_dump($user->get(1));
  }

  public function post ($args) {
    print_r($args);
  }

  public function post_json ($args) {
    print_r(json_encode($args));
  }

}
