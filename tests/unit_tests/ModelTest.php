<?php

  namespace Tests;

  if (!defined ('ROOT_DIR'))
    define ('ROOT_DIR', dirname(dirname(__DIR__)), true);

  /*require_once (ROOT_DIR . '/app/framework/core/Tools/Session.php');
  require_once (ROOT_DIR . '/app/application/controllers/Controller.php');
  require_once (ROOT_DIR . '/app/application/controllers/HTTPErrorsController.php');
  require_once (ROOT_DIR . '/app/framework/core/Exceptions/InvalidDatabaseException.php');*/
  require_once (ROOT_DIR . '/app/framework/core/Database/Database.php');
  require_once (ROOT_DIR . '/app/framework/core/Database/Query.php');
  require_once (ROOT_DIR . '/app/framework/core/Database/QueryBuilder.php');
  require_once (ROOT_DIR . '/app/application/models/Model.php');
  require_once (ROOT_DIR . '/app/application/models/UserModel.php');

class ModelTest extends \PHPUnit_Framework_TestCase {

  public function testUserModel () {
    $arrayUser = array(
      'tablename' => 'user',
      'fields' => array(
        0 => array (
          'field' => 'uid',
          'properties' =>
          array (
            0 => 'primary',
            1 => 'autoincrement'
          ),
          'type' => 'integer'
        ),
        1 => array(
          'field' => 'username',
          'size' => '255',
          'type' => 'varchar'
        ),
        2 => array (
          'field' => 'passwd',
          'size' => '512',
          'type' => 'varchar'
        ),
        3 => array (
          'field' => 'role',
          'type' => 'integer'
        )
      )
    );

    $users = array(
      'engine'    => 'mysql',
      'host'       => 'localhost',
      'username'  => 'root',
      'password'   => '',
      'port'      => '3306',
      'database'  => 'users'
    );
    $user_db = new \Database($users);
    \Connections::add('user', $user_db);

    $user = new \UserModel;
    $user_table = $user->get_array();

    $this->assertEquals($arrayUser, $user_table);
  }


  public function testTableName () {
    $users = array(
      'engine'    => 'mysql',
      'host'       => 'localhost',
      'username'  => 'root',
      'password'   => '',
      'port'      => '3306',
      'database'  => 'users'
    );
    $user_db = new \Database($users);
    \Connections::add('user', $user_db);

    $userModel = new \UserModel;
    $user_table = $userModel->table_name();

    $this->assertEquals($user_table, 'user');
  }
}
