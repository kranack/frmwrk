<?php

  namespace Tests;

  require_once ('core/Headers.php');

class HeadersTest extends \PHPUnit_Framework_TestCase {

  public function test404Header () {
    $header = \Headers::set_response ('404');

    $header404 = "HTTP/1.1 404 Page Not Found";
    $this->assertEquals($header, $header404);
  }

  public function testUTF8CharSet () {
    $charset = \Headers::set_charset ('utf-8');

    $utf8 = "charset=utf-8";
    $this->assertEquals($charset, $utf8);
  }

  public function testMustBeFalse () {
    $header = \Headers::set_response ('404');

    $header403 = "HTTP/1.1 403 Page Not Found";
    $this->assertFalse($header === $header403);
  }

}
