<?php
/******************************************
 * @file config.php
 * @author Damien Calesse
 * @date 18/07/2015
 * @description Config file for framework
 ******************************************/

 if (PATH_SEPARATOR === ';') {
   define('PATH_SEPARATORS', '/', true);
 } else {
   define('PATH_SEPARATORS', PATH_SEPARATOR);
 }

  /* Global configurations */
  define ('CORE_DIRECTORY', 'core');

  define ('MODELS_DIRECTORY', 'models');

  define ('ROOT_DIRECTORY', $_SERVER['DOCUMENT_ROOT']);

  define ('ROOT_PATH' , '/');

  //define ('MODEL_PATH', ROOT_PATH . PATH_SEPARATORS . MODEL_DIRECTORY );


  define ('DEFAULT_CONF_FILE', ROOT_DIRECTORY . 'config' . DIRECTORY_SEPARATOR . 'system.json');
