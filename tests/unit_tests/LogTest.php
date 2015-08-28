<?php

  namespace Tests;

  if (!defined ('ROOT_DIR'))
    define ('ROOT_DIR', dirname(dirname(__DIR__)), true);

  require_once (ROOT_DIR . '/app/framework/core/Tools/Log.php');
  require_once (ROOT_DIR . '/app/framework/core/Exceptions/FileNotFoundException.php');

class LogTest extends \PHPUnit_Framework_TestCase {

  public function testLogFileExists () {
    $log_path = ROOT_DIRECTORY . LOG_DIRECTORY . DIRECTORY_SEPARATOR . DEFAULT_LOG_FILE;
    $this->assertFileExists($log_path);
  }

  public function testWriteLog () {
    \Log::record ('CoreTest', 'Just a test');
    $log = \Log::get();

    $this->assertFalse($log === '');
  }

  public function testDropLog () {
    \Log::drop();
    $log = \Log::get();

    $this->assertEquals($log, '');
  }

  public function testChangeLogFile () {
    $this->assertNull(\Log::set('logs/test.txt'));
  }

}
