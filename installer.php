<?php

  function help ($cmds) {
    foreach ($cmds as $cmd => $arr) {
      print_r("$cmd\t\t$arr[0]\t$arr[1]\t$arr[2]\r\n");
    }
    die();
  }

  function database() {
    print_r("create some config for the database");
  }

  function modules_list($cmds) {
    $dh  = opendir("modules");
    $files = "";
    while (false !== ($filename = readdir($dh))) {
      if(!in_array($filename,array(".",".."))) {
        $files .= $filename . "\r\n";
      }
    }
    print_r("Installed Modules :\r\n");
    print_r($files);
  }

  function extract_cmd ($arg, $cmds) {
    $_cmds = array();
    foreach ($cmds as $cmd => $_a) {
      $_cmds [$_a[0]] = $cmd;
      $_cmds [$_a[1]] = $cmd;
    }
    if (!array_key_exists($arg, $_cmds)) {
      //return null;
    }
    $_cmds[$arg]($cmds);
  }

  $_cmd = array(
    "help" => array(
      "-h", "--help", "display this help section"
    ),
    "database" => array(
      "-db", "--database", "configure a database"
    ),
    "modules_list" => array(
      "-mod", "--modules", "display modules"
    ),
    "module_disable" => array(
      "-dismod", "--disable_module", "disable a module"
    ),
    "module_enable" => array(
      "-enmod", "--enable_module", "enable a module"
    )
  );

  if ($argc < 2) {
    print_r("You have to give at least 1 valid parameter\r\n");
    help($_cmd);
  }

  $_args = array_slice($argv, 1);
  for ($i=0; $i<$argc-1; $i++) {
    $arg = $_args[$i];
    $r = extract_cmd($arg, $_cmd);
    if ($r === null) {
      print_r("Invalid Command\r\n");
      help($_cmd);
    }
  }
