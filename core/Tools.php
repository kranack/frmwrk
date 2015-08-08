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
    $setup = array('blowfish', 'cbc', base64_decode($m->n), $m->s);
    return Security::check($pwd, $a->b, $setup);
  }

  public static function admin_logged () {
    Session::start();
    if (Session::get('user') === null) {
      Tools::redirect('/admin/login');
    }
  }

  public static function add_admin ($login, $pwd) {
    /* Password encryption */
    var_dump($pwd);
    $p = Security::encrypt('blowfish', $pwd);
    var_dump($p);
    /* Add to db new admin */
    $db = Connections::get('core');
    $db->insert('a', array('b' => $p['ciphertext']));
    $aid = $db->last_id;
    $db->insert('m', array('n' => base64_encode($p['key']), 's' => $p['iv_size'] ));
    $mid = $db->last_id;
    $r = $db->insert('core_admin', array('login' => $login, 'a' => $aid, 'm' => $mid));
  }

}
