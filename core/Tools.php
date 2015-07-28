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

}
