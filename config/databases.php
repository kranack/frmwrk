<?php

  /* Database configuration */

  $users = array(
    'engine'    => 'mysql',
    'host'       => 'localhost',
    'username'  => 'root',
    'password'   => '',
    'port'      => '3306',
    'database'  => 'users'
  );

  $posts = array(
    'engine'    => 'mysql',
    'host'       => 'localhost',
    'username'  => 'root',
    'password'   => '',
    'port'      => '3307',
    'database'  => 'posts'
  );

  $core = array(
    'engine'    => 'mysql',
    'host'       => 'localhost',
    'username'  => 'root',
    'password'   => '',
    'port'      => '3306',
    'database'  => 'core'
  );

  $user_db = new Database($users);
  Connections::add('user', $user_db);
  $post_db = new Database($posts);
  Connections::add('post', $post_db);
  $core_db = new Database($core);
  Connections::add('core', $core_db);

  //Connections::add('test', "string");

  /* Migration */
  $user = new UserModel();
  //$user->migrate();
  $post = new PostModel();
  //$post->migrate();
