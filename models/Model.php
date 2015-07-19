<?php
/*********************************
 * Utiliser Reflection pour
 * création des tables dans la BDD
 ********************************/
class Model {

  protected function insert() {}

  protected function update() {}

  protected function delete() {}

  protected function get_vars () {
    $model = get_called_class();
    $params = get_class_vars($model);
    $vars = array();
    foreach ($params as $k => $e) {
      $ft = new ReflectionProperty($model, $k);
      $comments = $ft->getDocComment();
      $dfd = explode("\n", str_replace("\r", "", $comments));
      $properties = array();
      foreach ($dfd as $m) {
        $props = explode("@", $m);
        if (count($props) > 1) {
          $data = explode(" ", $props[1]);
          if (!isset($properties[$data[0]]) && isset($data[1])) {
            $properties[$data[0]] = $data[1];
          } elseif (!isset($properties[$data[0]])) {
            $properties["properties"][] = $data[0];
          }
        }
      }
      $vars [] = $properties;
    }
    return $vars;
  }

  public function import_db () {
    $vars = $this->get_vars();
    $conn = new Connections("self");
    $conn->connect();
  }

}