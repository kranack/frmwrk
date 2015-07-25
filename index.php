<?php
  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $start = $time;

  require_once (__DIR__ . DIRECTORY_SEPARATOR .'requires.php');

  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $finish = $time;
  $total_time = round(($finish - $start), 4);
  var_dump('Page generated in '.$total_time.' seconds.');
