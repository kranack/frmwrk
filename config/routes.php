<?php

  $router = new Router;

  $router->add('GET', '/', 'HomeController');
  $router->add('GET', '/json', 'HomeController', 'json');
  $router->add('GET', '/contact', 'ContactController');
  $router->add('GET', '/test', 'TestController');
  $router->add('GET', '/infos', 'InfosController');
  $router->add('GET', '/user', 'UserController');
  $router->add('GET', '/user/:name', 'UserController');
  $router->add('GET', '/security', 'SecurityController');

  //$router->add('POST', '/user/:name', 'UserController', 'post');
  //$router->add('POST', '/user/:name/json', 'UserController', 'post_json');

  if (empty($_GET['r'])) {
    $route = '/';
  } else {
    $route = '/' . $_GET['r'];
  }

  try {
    $method = strtoupper($_SERVER["REQUEST_METHOD"]);
    echo $router->search($method, $route);
  } catch (HTTPException $e) {
    $c = new HTTPErrorsController();
    $func = "_".$e->getMessage();
    $c->$func();
  }
