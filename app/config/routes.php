<?php

  /* Set cache configuration */
  $cache_callback = [
    'class'   => 'Modules\Cache\CacheModule',
    'method'  => 'save'
  ];

  $router = new Router($cache_callback);

  $router->get('/', 'HomeController');
  /* Admin routes */
  $router->datas('/admin', 'AdminController');
  $router->datas('/admin/login', 'AdminController', 'login');
  $router->get('/admin/logout', 'AdminController', 'logout');
  $router->get('/admin/users', 'AdminController', 'users');
  $router->datas('/admin/add_admin', 'AdminController', 'add_admin');
  $router->datas('/admin/modules', 'AdminController', 'modules');

  $router->get('/admin/modules/:module', 'AdminController', 'module_infos');
  $router->post('/admin/modules/edit', 'AdminController', 'module_edit');
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

  $method = strtoupper($_SERVER["REQUEST_METHOD"]);

  /* If cache is enabled */
  if (Modules\Cache\CacheModule::is_enabled()
      && Modules\Cache\CacheModule::is_cached()
      && $method === 'GET') {
    Modules\Cache\CacheModule::dump();
  } else {
    try {
      echo $router->search($method, $route);
    } catch (HTTPException $e) {
      $c = new HTTPErrorsController();
      $func = "_".$e->getMessage();
      $c->$func();
    }
  }
