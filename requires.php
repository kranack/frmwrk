<?php

  require_once ('config' . DIRECTORY_SEPARATOR . 'config.php');
  require_once (CORE_DIRECTORY . DIRECTORY_SEPARATOR . 'Core.php');

  Core::require_all();

  Config::load();

  require_once ('config' . DIRECTORY_SEPARATOR . 'autoload.php');
  require_once ('config' . DIRECTORY_SEPARATOR . 'databases.php');
  require_once ('config' . DIRECTORY_SEPARATOR . 'routes.php');
