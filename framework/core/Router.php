<?php
/*******************************************
* Router Class
* @author Damien Calesse
* @date 18/07/2015
* @description Routing class
*******************************************/
class Router {

  private $_routes = array();
  private $_callback = array();

  public function __construct($callback = null) {
    $this->_routes = array('GET' => array(), 'POST' => array(), 'PUT' => array(), 'DELETE' => array());
    if ($callback !== null) {
      $this->_callback = $callback;
      $this->_callback['callable'] = $this->set_callable($callback['class'], $callback['method'], true);
    }
  }

  public function get ($path, $controller, $method = 'index') {
    $this->add('GET', $path, $controller, $method);
  }

  public function post ($path, $controller, $method = 'index') {
    $this->add('POST', $path, $controller, $method);
  }

  public function delete ($path, $controller, $method = 'index') {
    $this->add('DELETE', $path, $controller, $method);
  }

  public function put ($path, $controller, $method = 'index') {
    $this->add('PUT', $path, $controller, $method);
  }

  public function datas ($path, $controller, $method = 'index') {
    $this->add('GET', $path, $controller, $method);
    $this->add('POST', $path, $controller, $method);
  }

  public function add ($type, $path, $controller, $method = 'index') {
    try {
      if (!in_array($type, array_keys($this->_routes))) {
        throw new RouterTypeException($type);
      }
      $r = $this->extract_args($path);
      $callable = $this->set_callable($controller, $method);
      $this->_routes [$type][] = array('path' => $r['path'], 'func' => $callable, 'args' => $r['args']);
    } catch (RouterTypeException $e) {
      die($e->getMessage());
    }

    return $this;
  }

  public function search ($method, $route = null) {
    $_route = $route;
    if ($_route !== "/") {
      $_route = $this->clean_route($route);
    }

    foreach ($this->_routes[$method] as $a) {
      $args = array();
      if (count($a['args']) > 0) {
        $_route = $this->catch_args($_route, $a);
        (isset($_route['args'])) ? $args = $_route['args'] : $args = array();
        $_route = $_route['path'];
      }
      if ($_route === $a['path']) {
        $r = $a['func']($args);
        if (!empty($this->_callback) && $method === 'GET') {
          $this->_callback['callable']($r);
        }
        return $r;
      }
    }
    throw new HTTP404Exception($route, $method);
  }

  private function set_callable ($controller, $method, $callback = false) {
    $callable = function() use ($controller, $method, $callback) {
      static $obj = null;
      if ($obj === null) {
        $obj = new $controller;
      }
      if ($callback === false) {
        return call_user_func_array(array($obj, 'exec'), array($method, func_get_args()));
      }
      return call_user_func_array(array($obj, $method), func_get_args());
    };
    if (!is_callable($callable)) {
      throw new Exception("Invalid callable arg");
    }
    return $callable;
  }

  private function clean_route ($route) {
    if ($route === null) {
      return null;
    }

    $route = trim($route);
    //$route = strtolower($route);

    $route = rtrim($route, "/");
    do {
      $route = str_replace("//", "/", $route);
    } while (strstr($route, "//"));
    $route = addslashes($route);
    return $route;
  }

  private function extract_args ($route) {
    $_r = explode("/", $route);
    $args = array();
    $r = "/";
    foreach ($_r as $s) {
      if ($s !== '') {
        if (strstr($s, ":")) {
          $args [] = str_replace(":", "", $s);
        } else {
          $r .= $s."/";
        }
      }
    }
    return array('args' => $args, 'path' => ($r === "/") ? $r : rtrim($r, "/"));
  }

  private function catch_args ($route, $__route) {
    $cpt_route = count(explode('/', $__route['path']));
    $cpt_route += count($__route['args']);

    $expl = array();
    if ($route !== '/') {
      $expl = explode('/', $route);
    }
    $cpt = count($expl);

    if ($cpt >= $cpt_route) {
      return array(
        'path' => implode('/', array_slice($expl, 0, $cpt-1)),
        'args' => array_slice($expl, $cpt-1)
      );
    } else {
      return array('path' => $route);
    }
  }
}
