<?php

class UserController extends Controller {


  public function index () {
    $user = new UserModel();
    $user->import_db();
  }

}
