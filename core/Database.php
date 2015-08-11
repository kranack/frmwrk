<?php

class Database {

  private $__env = null;
  private $__pdo = null;
  public $last_id = null;

  public function __construct ($conf = array()) {
    if (empty($conf)) {
      return null;
    }
    $this->__env = (object) $conf;
    $this->build();

    return $this;
  }

  private function build() {
    $this->last_id = 0;
  }

  public function pdo() {
    $this->__pdo = null;
    $param = $this->__env->engine . ':host=' . $this->__env->host . ';port=' . $this->__env->port . ';dbname=' . $this->__env->database;
    try {
      $this->__pdo = new PDO($param, $this->__env->username, $this->__env->password);
    }
    catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
    $this->__pdo->exec("SET NAMES 'UTF8'");
    return $this->__pdo;
  }

  public function query($sql, $params = null) {
    $pdo = $this->pdo();
    $q = $pdo->query($sql);

    return (object) array("pdo" => $pdo, "statement" => $q);
  }

  public function exec($sql) {
    $pdo = $this->pdo();
    return $pdo->exec($sql);
  }

  public function execute($sql, $params = null) {
    $pdo = $this->pdo();
    var_dump($sql);
    if ($params !== null) {
      $q = $pdo->prepare($sql)->execute($params);
    }
    $q = $pdo->query($sql);

    return (object) array("pdo" => $pdo, "statement" => $q);
  }

  public function fetch(PDOStatement $statement, $method = PDO::FETCH_OBJ) {
    return $statement->fetch($method);
  }

  public function fetchAll(PDOStatement $statement, $method = PDO::FETCH_OBJ) {
    return $statement->fetchAll($method);
  }

  public function insert($table, $values = array()) {
    if (empty($values)) {
      return null;
    }

    $p = array();
    foreach ($values as $k => $v) {
      $p[':'.$k] = $v;
    }

    $sql = 'INSERT INTO `'. $table .'` ( `'. implode('`, `', array_keys($values)) .'` ) VALUES ( :'.implode(', :',array_keys($values)) .' )';
    try {
      $q = $this->execute($sql, $p);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    return $q->lastInsertID();
  }

  public function delete($table, $condition = array()) {
    if (empty($condition)) {
      $sql = 'DELETE FROM `'. $table .'` WHERE 1';
    } else {
      $sql = 'DELETE FROM `'. $table .'` WHERE :'. implode(',:',array_keys($condition));
    }

    try {
      return $this->execute($sql, $condition);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function update($table, $fields, $condition = array(), $params = array()) {
    $value = '';
    foreach ($fields as $f) {
      $value .= $f . '= :'.$f . ',';
    }
    rtrim($value, ',');

    if (empty($condition)) {
      $sql = 'UPDATE `'. $table .'` SET '. $value . ' WHERE 1';
    } else {
      $sql = 'UPDATE `'. $table .'` SET '. $value . ' WHERE '. implode(',:',array_keys($condition));
    }

    try {
      return $this->execute($sql, array_merge($fields, $condition));
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function select($table, $champ = array(), $condition = 1, $params = array()) {
    $fields = " ";
    if (empty($champ)) {
      $fields = "*";
    }
    else {
      $fields = implode(',', array_values($champ));
    }
    $sql = 'SELECT ' . $fields . ' FROM `'. $table . '` WHERE '. $condition;

    return $this->execute($sql);
  }

  public function import_model ($model_params) {
    if (!empty($model_params)) {
      $this->_create_table($model_params);
    }

    return $this;
  }

  private function _create_table ($params) {
    $tablename = $params['tablename'];

    $sql = "CREATE TABLE IF NOT EXISTS `$tablename`(";
    $properts = array();
    $keys = array();
    foreach ($params['fields'] as $param) {
      $properts[$param['field']] = "`". $param['field'] ."` " . $param['type'];
      if (isset($param["size"])) {
        $properts[$param['field']].="(" . $param['size'] . ")";
      }
      if (isset($param["properties"])) {
        if (in_array("primary", $param["properties"])) {
          $keys [] = $param['field'];
        }
        if (in_array("autoincrement", $param["properties"])) {
          $properts[$param['field']] .= " NOT NULL AUTO_INCREMENT";
        }
      }
    }
    $sql.= implode(",\n", $properts);
    $sql .=",\nCONSTRAINT pk_$tablename PRIMARY KEY(`" . implode("`,`", $keys) . "`)";
    $sql.=");";

    $this->exec($sql);
  }


}
