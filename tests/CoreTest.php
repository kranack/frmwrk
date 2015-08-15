<?php

  namespace Tests;

  require_once ('framework/core/Core.php');

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
