<?php
/**
 * @file config.php
 * @authors Kranack
 * @date 19/08/2015
 * @description Config file for framework
 */

 if (PATH_SEPARATOR === ';') {
   define('PATH_SEPARATORS', '/', true);
 } else {
   define('PATH_SEPARATORS', PATH_SEPARATOR);
 }

  /**
   * Default configurations
   */
  define ('DEFAULT_TIMEZONE', 'Europe/Paris');

  define ('DEFAULT_LOG_FILE', 'log.txt');

  /**
   * Directories configuration
   */

  /* Main directories */

  define ('ROOT_DIRECTORY', $_SERVER['DOCUMENT_ROOT']);

  define ('ROOT_PATH' , '/');

  define ('APP_DIRECTORY', 'application');

  define ('FRAMEWORK_DIRECTORY', 'framework');

  define ('DATA_DIRECTORY', 'data');

  /* Sub directories */

  define ('CORE_DIRECTORY', FRAMEWORK_DIRECTORY . DIRECTORY_SEPARATOR . 'core');

  define ('CONTROLLERS_DIRECTORY', APP_DIRECTORY . DIRECTORY_SEPARATOR . 'controllers');

  define ('MODELS_DIRECTORY', APP_DIRECTORY . DIRECTORY_SEPARATOR . 'models');

  define ('HOOKS_DIRECTORY', APP_DIRECTORY . DIRECTORY_SEPARATOR . 'hooks');

  define ('MODULES_DIRECTORY', FRAMEWORK_DIRECTORY . DIRECTORY_SEPARATOR . 'modules');

  define ('LOG_DIRECTORY', DATA_DIRECTORY . DIRECTORY_SEPARATOR . 'logs');

  /* Core sub directories */

  define ('CORE_DIRECTORY_CORE', CORE_DIRECTORY . DIRECTORY_SEPARATOR . 'Core');

  define ('CORE_DIRECTORY_DB', CORE_DIRECTORY . DIRECTORY_SEPARATOR . 'Database');

  define ('CORE_DIRECTORY_TOOLS', CORE_DIRECTORY . DIRECTORY_SEPARATOR . 'Tools');


  define ('DEFAULT_CONF_FILE', ROOT_DIRECTORY . 'config' . DIRECTORY_SEPARATOR . 'system.json');

  /**
   * View configuration
   */
  define ('DEFAULT_VIEW_TITLE', 'Well, there is no title here my friend');
