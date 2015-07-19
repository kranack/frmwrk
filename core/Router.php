<?php
/*******************************************
* Router Class
* @author Damien Calesse
* @date 18/07/2015
* @description Routing class 
*******************************************/
class Router {

  private $_routes = array();

  public function __construct() {
    $this->_routes = array('GET' => array(), 'POST' => array(), 'PUT' => array(), 'DELETE' => array());
  }

  public function add ($type, $path, $controller, $method = 'index') {
    try {
      if (!in_array($type, array_keys($this->_routes))) {
        throw new RouterTypeException("Type not valid (". $type .")");
      }
      $callable = $this->set_callable($controller, $method);
      $this->_routes [$type][] = array('path' => $path, 'func' => $callable);
    } catch (RouterTypeException $e) {
      print_r($e->getMessage());
    }

    return $this;
  }

  public function search ($method, $route = null) {
    $_route = $this->clean_route($route);
    foreach ($this->_routes[$method] as $a) {
      if ($route === $a['path']) {
        return $a['func']();
      }
    }
    throw new Exception ("Invalid Route");
  }

  public function set_callable ($controller, $method) {
    $callable = function() use ($controller, $method) {
      static $obj = null;
      if ($obj === null) {
        $obj = new $controller;
      }
      return call_user_func_array(array($obj, $method), func_get_args());
    };
    if (!is_callable($callable)) {
      throw new Exception("Invalid callable arg");
    }
    return $callable;
  }

  private function clean_route($route) {
    if ($route === null) {
      return null;
    }

    $route = trim($route);
    $route = strtolower($route);

    $route = trim($route, "/");
    do {
      $route = str_replace("//", "/", $route);
    } while (strstr($route, "//"));
    $route = addslashes($route);
    return $route;
  }

}