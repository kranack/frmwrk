<?php
/**
 *
 *	@file=autoload.php
 *	@description=Autoload function (seek & load)
 *	@author=Damien Calesse
 *
 */

function autoload ($classname) {

  if (file_exists(CORE_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php')) {
    require_once (CORE_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php');
  } elseif (file_exists(CORE_DIRECTORY . DIRECTORY_SEPARATOR . 'Exceptions' . $classname . '.php')) {
    require_once (CORE_DIRECTORY . DIRECTORY_SEPARATOR . 'Exceptions' . $classname . '.php');
  } elseif (file_exists(MODELS_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php')) {
    require_once (MODELS_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php');
  } elseif (file_exists(HOOKS_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php')) {
    require_once (HOOKS_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php');
  } elseif (file_exists(MODULES_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php')) {
    require_once (MODULES_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php');
  } elseif (file_exists(CONTROLLERS_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php')) {
    require_once (CONTROLLERS_DIRECTORY . DIRECTORY_SEPARATOR . $classname . '.php');
  }
  /*if (endsWith(strtolower($classname), "controller")) {
    $seek_dir = 'controllers';
  } else if (endsWith(strtolower($classname), "view")) {
    $seek_dir = 'views';
  } else if (endsWith(strtolower($classname), "model")) {
    $seek_dir = 'models';
  }

  $filename = ROOT_DIRECTORY . $seek_dir . DIRECTORY_SEPARATOR . $classname . '.php';
  require_once($filename);
  if ($p = get_parent_class($classname)) {
    require_once(ROOT_DIRECTORY . $seek_dir . DIRECTORY_SEPARATOR . $p . '.php');
  }
  if ($interfaces = class_implements($classname))
  foreach ($interfaces as $interface) {
    require_once(ROOT_DIRECTORY . $seek_dir . DIRECTORY_SEPARATOR . $interface . '.php');
  }*/
}

spl_autoload_register('autoload');

function endsWith($haystack, $needle)
{
  return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}
