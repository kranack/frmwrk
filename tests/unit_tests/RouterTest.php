<?php

  namespace Tests;

  define ('DEFAULT_VIEW_TITLE', 'Oulalala y\'a pas de titre');

  define ('APP_DIRECTORY', 'application');

  if (PATH_SEPARATOR === ';') {
    define('PATH_SEPARATORS', '/', true);
  } else {
    define('PATH_SEPARATORS', PATH_SEPARATOR);
  }

  if (!defined ('ROOT_DIR'))
    define ('ROOT_DIR', dirname(dirname(__DIR__)), true);

  require_once (ROOT_DIR . '/app/framework/core/Core/Router.php');

  require_once (ROOT_DIR . '/app/framework/core/Core/View.php');

  require_once (ROOT_DIR . '/app/application/controllers/Controller.php');

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
