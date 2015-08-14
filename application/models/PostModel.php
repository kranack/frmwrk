<?php

class PostModel extends Model {

  /**
  * @field uid
  * @primary
  * @autoincrement
  * @type integer
  */
  protected $pid;

  /**
  * @field username
  * @size 255
  * @type varchar
  */
  protected $name;


  public function table_name () {
    return 'post';
  }

  public function insert ($args) {
    $db = Connections::get('post');
    var_dump($db);
    $db->insert('post', $args);
  }

  public function update ($args) {}

  public function delete ($args) {}

}
