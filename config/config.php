<?php
/**
 * @file config.php
 * @authors Kranack
 * @date 18/07/2015
 * @description Config file for framework
 */

 if (PATH_SEPARATOR === ';') {
   define('PATH_SEPARATORS', '/', true);
 } else {
   define('PATH_SEPARATORS', PATH_SEPARATOR);
 }

  /* Default configurations */
  define ('DEFAULT_TIMEZONE', 'Europe/Paris');

  define ('DEFAULT_LOG_FILE', 'log.txt');

  /* Global configurations */
  define ('APP_DIRECTORY', 'application');

  define ('FRAMEWORK_DIRECTORY', 'framework');

  define ('CORE_DIRECTORY', FRAMEWORK_DIRECTORY . DIRECTORY_SEPARATOR . 'core');

  define ('CONTROLLERS_DIRECTORY', APP_DIRECTORY . DIRECTORY_SEPARATOR . 'controllers');

  define ('MODELS_DIRECTORY', APP_DIRECTORY . DIRECTORY_SEPARATOR . 'models');

  define ('HOOKS_DIRECTORY', APP_DIRECTORY . DIRECTORY_SEPARATOR . 'hooks');

  define ('MODULES_DIRECTORY', FRAMEWORK_DIRECTORY . DIRECTORY_SEPARATOR . 'modules');

  define ('LOG_DIRECTORY', 'logs');

  define ('ROOT_DIRECTORY', $_SERVER['DOCUMENT_ROOT']);

  define ('ROOT_PATH' , '/');

  //define ('MODEL_PATH', ROOT_PATH . PATH_SEPARATORS . MODEL_DIRECTORY );


  define ('DEFAULT_CONF_FILE', ROOT_DIRECTORY . 'config' . DIRECTORY_SEPARATOR . 'system.json');

  /* View configuration */
  define ('DEFAULT_VIEW_TITLE', 'Oulalala y\'a pas de titre');
