<?php

class HomeController extends Controller {

  public function index($args) {
    $this->__view->set_content_type("html");
    $this->__view->set_body('home', 'index.tpl');
    $this->__view->set_css(array('default.css'));
    $this->__view->attach_data(array("title" => "Home"));
    $this->__view->display();


    var_dump(Security::hash('sha256', 'test'));

    $c = Security::encrypt('blowfish', 'test');
    $e = Security::decrypt($c['ciphertext'], 'blowfish', 'cbc', $c['key'], $c['iv_size']);
    var_dump('test : ' . $c['ciphertext']);
    var_dump('test : ' . $e);

  }

  public function json() {
    $this->__view->set_content_type("json", "utf-8");
    $this->__view->attach_data(array("title" => "Test JSON"));
    print_r("{'name':'Damien'}");
  }

}
