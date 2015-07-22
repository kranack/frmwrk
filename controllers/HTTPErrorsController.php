<?php

class HTTPErrorsController extends Controller {

  public function _404 () {

    $this->__view->set_content_type("html");
    $this->__view->set_body('errors', '404.tpl');
    $this->__view->set_css(array('errors.css'));
    $this->__view->attach_data(array("title" => "404 - Page Not Found"));
    $this->__view->display();

  }

  public function _403 () {

    $this->__view->set_content_type("html");
    $this->__view->set_body('errors', '403.tpl');
    $this->__view->attach_data(array("title" => "403 - Forbidden"));
    $this->__view->display();

  }

  public function _500 () {

    $this->__view->set_content_type("html");
    $this->__view->set_body('errors', '500.tpl');
    $this->__view->attach_data(array("title" => "404 - Internal Server Error"));
    $this->__view->display();

  }

}
