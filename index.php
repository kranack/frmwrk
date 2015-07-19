<?php

  $time_pre = microtime(true);
  require_once (__DIR__ . DIRECTORY_SEPARATOR .'requires.php');
  $time_post = microtime(true);
  $exec_time = $time_post - $time_pre;
//var_dump($exec_time);
