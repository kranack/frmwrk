<?php

class Tools {

  public static function ip () {
    return $_SERVER['REMOTE_ADDR'];
  }

  public static function data ($type = 'POST') {
    return ($type === 'POST') ? $_POST : $_GET;
  }

  public static function redirect ($url = '/') {
    Headers::save(Headers::location($url));
  }

  public static function is_admin ($login, $pwd = null) {
    $db = Connections::get('core');
    $r = $db->fetch($db->select('core_admin', array('a', 'm'), "login = '$login'"));

    if ($pwd === null) {
      return count($r) === 1;
    }

    if (count($r) !== 1) {
      return 0;
    }

    $a = $db->fetch($db->select('a', array(), "aid = '$r->a'"));
    $m = $db->fetch($db->select('m', array(), "mid = '$r->m'"));
    $setup = array('blowfish', 'cbc', $m->n, $m->s);
    return Security::check($pwd, $a->b, $setup);
  }

}
