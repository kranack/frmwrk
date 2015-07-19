<?php

  $router = new Router;

  $router->add('GET', '/', 'HomeController');
  $router->add('GET', '/json', 'HomeController', 'json');
  $router->add('GET', '/test', 'TestController');
  $router->add('GET', '/infos', 'InfosController');
  $router->add('GET', '/user', 'UserController');

  //$router->add('PUT', '/put', 'PutController');

  if (empty($_GET['r'])) {
    $route = '/';
  } else {
    $route = '/' . $_GET['r'];
  }

  try {
    $method = strtoupper($_SERVER["REQUEST_METHOD"]);
    echo $router->search($method, $route);
  } catch (Exception $e) {
    print_r($e->getMessage());
  }