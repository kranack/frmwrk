<?php

  namespace Tests;

  define ('DATA_DIRECTORY', 'data');

  define ('LOG_DIRECTORY', DATA_DIRECTORY . DIRECTORY_SEPARATOR . 'logs');

  define ('DEFAULT_TIMEZONE', 'Europe/Paris');

  define ('DEFAULT_LOG_FILE', 'log.txt');

  if (!defined ('ROOT_DIR'))
    define ('ROOT_DIR', dirname(dirname(__DIR__)), true);

  define ('ROOT_DIRECTORY', ROOT_DIR . '/app/');

  define ('FRAMEWORK_DIRECTORY', 'framework');

  define ('CORE_DIRECTORY', FRAMEWORK_DIRECTORY . DIRECTORY_SEPARATOR . 'core');

  require_once (ROOT_DIR . '/app/framework/core/Core/Core.php');

class CoreTest extends \PHPUnit_Framework_TestCase {

  public function testLoadFile () {
    \Core::require_file ('core', 'Tools\Log.php');

    $this->assertTrue(\Core::is_loaded('core\Tools\Log.php'));
  }

  public function testLaunchFile () {
    \Core::require_file ('core', 'Tools\Log.php');

    \Log::drop();
    \Log::record ('CoreTest', 'Just a test');
    $log = \Log::get();
    $datetime = date ('d-m-Y H:i:s');
    $this->assertEquals($log, "[$datetime] : Just a test (CoreTest)\r\n");
  }

}
