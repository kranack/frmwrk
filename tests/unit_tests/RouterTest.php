<?php

  namespace Tests;

  define ('DEFAULT_VIEW_TITLE', 'Oulalala y\'a pas de titre');

  define ('APP_DIRECTORY', 'application');

  if (PATH_SEPARATOR === ';') {
    define('PATH_SEPARATORS', '/', true);
  } else {
    define('PATH_SEPARATORS', PATH_SEPARATOR);
  }

  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/Router.php');

  require_once ($_SERVER['DOCUMENT_ROOT'] . 'framework/core/View.php');

  require_once ($_SERVER['DOCUMENT_ROOT'] . 'application/controllers/Controller.php');

  class RouterTest extends \PHPUnit_Framework_TestCase {

    public function testGetRoute () {
      $router = new \Router();

      $router->get('/', 'Tests\TestController');
      $this->assertEquals('get', $router->search('GET', '/'));
    }

    public function testPostRoute () {
      $router = new \Router();

      $router->get('/post', 'Tests\TestController', 'post');
      $this->assertEquals('post', $router->search('GET', '/post'));
    }

    public function testDatasRoute () {
      $router = new \Router();

      $router->datas('/', 'Tests\TestController', 'getPost');
      $this->assertEquals('getPost', $router->search('GET', '/'));
      $this->assertEquals('getPost', $router->search('POST', '/'));
    }

  }


  class TestController extends \Controller {

    public function index () {
      return 'get';
    }

    public function post () {
      return 'post';
    }

    public function getPost () {
      return 'getPost';
    }

  }
