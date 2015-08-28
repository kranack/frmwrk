<?php

class SecurityController extends Controller {

  public function index () {

    var_dump(Security::hash('sha256', 'test'));

    $c = Security::encrypt('blowfish', 'test', 'cbc');
    $e = Security::decrypt($c['ciphertext'], 'blowfish', 'cbc', $c['key'], $c['iv_size']);
    var_dump('test : ' . $c['ciphertext']);
    var_dump('test : ' . $e);

  }

}
