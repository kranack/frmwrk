<?php

  $router = new Router;

  $router->get('/', 'HomeController');
  /* Admin routes */
  $router->get('/admin', 'AdminController');
  $router->get('/admin/login', 'AdminController', 'login');
  $router->post('/admin/login', 'AdminController', 'login');
  $router->get('/admin/logout', 'AdminController', 'logout');
  $router->get('/admin/users', 'AdminController', 'users');
  $router->get('/admin/add_admin', 'AdminController', 'add_admin');
  $router->post('/admin/add_admin', 'AdminController', 'add_admin');
  $router->get('/admin/modules', 'AdminController', 'modules');
  /* Others */
  $router->get('/json', 'HomeController', 'json');
  $router->get('/contact', 'ContactController');
  $router->get('/infos', 'InfosController');
  $router->get('/user', 'UserController');
  $router->get('/user/:name', 'UserController');
  $router->get('/security', 'SecurityController');

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
