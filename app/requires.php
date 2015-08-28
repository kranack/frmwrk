<?php

  require_once ('config' . DIRECTORY_SEPARATOR . 'config.php');
  require_once (CORE_DIRECTORY_TOOLS . DIRECTORY_SEPARATOR . 'Config.php');
  require_once (CORE_DIRECTORY_CORE . DIRECTORY_SEPARATOR . 'Core.php');

  Config::load();
  Config::load_modules(true);
  Core::require_all();

  require_once ('config' . DIRECTORY_SEPARATOR . 'autoload.php');
  require_once ('config' . DIRECTORY_SEPARATOR . 'databases.php');
  require_once ('config' . DIRECTORY_SEPARATOR . 'routes.php');
