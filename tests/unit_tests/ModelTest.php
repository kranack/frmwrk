<?php

  namespace Tests;

  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/Database.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/Query.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/QueryBuilder.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] . 'application/models/Model.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] . 'application/models/UserModel.php');

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

    $user = new \UserModel;
    $user_table = $user->get_array();

    $this->assertEquals($arrayUser, $user_table);
  }


  public function testTableName () {
    $userModel = new \UserModel;
    $user_table = $userModel->table_name();

    $this->assertEquals($user_table, 'user');
  }
}
