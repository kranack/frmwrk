<?php

  namespace Tests;

  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/Database.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/Connections.php');

class ConnectionsTest extends \PHPUnit_Framework_TestCase {

  public function testConnectionDatabase () {
    $database = array(
      'engine'    => 'mysql',
      'host'       => 'localhost',
      'username'  => 'root',
      'password'   => '',
      'port'      => '3306',
      'database'  => 'users'
    );

    $db = new \Database($database);
    \Connections::add('test', $db);

    $this->assertEquals($db, \Connections::get('test'));
  }

  public function testMultipleDatabase () {
    $database = array(
      'engine'    => 'mysql',
      'host'       => 'localhost',
      'username'  => 'root',
      'password'   => '',
      'port'      => '3306',
      'database'  => 'test'
    );

    $database1 = array(
      'engine'    => 'mysql',
      'host'       => 'localhost',
      'username'  => 'root',
      'password'   => '',
      'port'      => '3307',
      'database'  => 'test1'
    );

    $db = new \Database($database);
    \Connections::add('test', $db);
    $db1 = new \Database($database1);
    \Connections::add('test1', $db1);

    $this->assertEquals($db, \Connections::get('test'));
    $this->assertEquals($db1, \Connections::get('test1'));
    $this->assertFalse($db === $db1);
  }

}
