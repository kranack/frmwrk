<?php

/* TODO: See to implements this interface http://php.net/manual/en/class.sessionhandlerinterface.php */

class Session {

  $__cookie_enabled = false;

  public function start () {
    return session_start();
  }

  public function destroy () {
    return session_destroy();
  }

  public function status () {
    return session_status();
  }

  public function reset () {
    return session_reset();
  }

  public function get ($key = null) {
    if ($key == null) {
      return $_SESSION;
    }
    return $_SESSION[$key];
  }

  public function set_cookie ($key, $value) {
    return setcookie($key, $value);
  }

  public function get_cookie ($key = null) {
    if ($key == null) {
      return $_COOKIE;
    }
    return $_COOKIE[$key];
  }

}
