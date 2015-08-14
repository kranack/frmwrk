<?php

class FileNotFoundException extends Exception {

  public function __construct ($path) {
    parent::__construct("Fichier non trouvé : " . $path);
  }

}
