<?php
  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $start = $time;

  require_once (__DIR__ . DIRECTORY_SEPARATOR .'requires.php');

  /*$sql = new QueryBuilder(Connections::get('test'));
  $sql->selectOne('penis')->from('penistable')->where('id = 2');
  $row = $sql->get();
  var_dump($row);

  $sql2 = new QueryBuilder(Connections::get('test'));
  $sql2->insert('vagina', array('penis'=>'1'));
  var_dump($sql2->run());

  $sql3 = new QueryBuilder(Connections::get('test'));
  $sql3->delete('penistable')->where('id=1');
  var_dump($sql3->run());

  $sql3 = new QueryBuilder(Connections::get('test'));
  $sql3->update('vagina', array('penis' => 2))->where('penis=1 OR penis=2 AND OR penis IS NOT NULL');
  var_dump($sql3->run());*/

  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $finish = $time;
  $total_time = round(($finish - $start), 4);

  if (strtoupper($_SERVER["REQUEST_METHOD"]) === 'GET') {
    var_dump('Page generated in '.$total_time.' seconds.');
  }
