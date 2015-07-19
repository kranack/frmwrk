<?php
/************************************
*
*	@file=autoload.php
*	@description=Autoload function (seek & load)
*	@author=Damien Calesse
*
************************************/

function __autoload ($classname) {
  $seek_dir = '';
  if (endsWith(strtolower($classname), "controller")) {
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
  }
}

function endsWith($haystack, $needle)
{
  return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}
