<?php

  namespace Tests;

  define ('DATA_DIRECTORY', 'data');

  define ('LOG_DIRECTORY', DATA_DIRECTORY . DIRECTORY_SEPARATOR . 'logs');

  define ('DEFAULT_TIMEZONE', 'Europe/Paris');

  define ('DEFAULT_LOG_FILE', 'log.txt');

  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/Core.php');

class CoreTest extends \PHPUnit_Framework_TestCase {

  public function testLoadFile () {
    \Core::require_file ('core', 'Log.php');

    $this->assertTrue(\Core::is_loaded('core\Log.php'));
  }

  public function testLaunchFile () {
    \Core::require_file ('core', 'Log.php');

    \Log::drop();
    \Log::record ('CoreTest', 'Just a test');
    $log = \Log::get();
    $datetime = date ('d-m-Y H:i:s');
    $this->assertEquals($log, "[$datetime] : Just a test (CoreTest)\r\n");
  }

}
