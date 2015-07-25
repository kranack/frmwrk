<?php

class HomeController extends Controller {

  public function index($args) {
    $this->__view->set_content_type("html");
    $this->__view->set_body('home', 'index.tpl');
    $this->__view->set_css(array('default.css'));
    $this->__view->attach_data(array("title" => "Home"));
    $this->__view->display();

    \Log::dump();
    \Log::drop();
    \Log::dump();
  }

  public function json() {
    $this->__view->set_content_type("json", "utf-8");
    $this->__view->attach_data(array("title" => "Test JSON"));
    print_r("{'name':'Damien'}");
  }

}
