<?php

/* TODO: See to implements this interface http://php.net/manual/en/class.sessionhandlerinterface.php */

class Session {

  private $__cookie_enabled = false;

  public static function start () {
    return session_start();
  }

  public static function destroy () {
    return session_destroy();
  }

  public static function status () {
    return session_status();
  }

  public static function reset () {
    return session_reset();
  }

  public static function get ($key = null) {
    if ($key == null) {
      return $_SESSION;
    }
    return $_SESSION[$key];
  }

  public static function set_cookie ($key, $value) {
    return setcookie($key, $value);
  }

  public static function get_cookie ($key = null) {
    if ($key == null) {
      return $_COOKIE;
    }
    return $_COOKIE[$key];
  }

}
