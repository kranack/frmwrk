<?php

  namespace Tests;

  require_once ('framework/core/Log.php');
  require_once ('framework/core/Exceptions/FileNotFoundException.php');

  define ('LOG_DIRECTORY', 'logs');

  define ('DEFAULT_LOG_FILE', 'log.txt');

class LogTest extends \PHPUnit_Framework_TestCase {

  public function testLogFileExists () {
    $log_path = LOG_DIRECTORY . DIRECTORY_SEPARATOR . DEFAULT_LOG_FILE;
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
