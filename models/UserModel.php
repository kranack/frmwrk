<?php

class UserModel extends Model {

  /**
   * @field uid
   * @primary
   * @autoincrement
   * @type integer
   */
  protected $uid;

  /**
  * @field username
  * @size 255
  * @type varchar
  */
  protected $username;

}