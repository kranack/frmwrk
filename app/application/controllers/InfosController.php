<?php

class InfosController extends Controller {


  public function index () {
    $this->__view->set_content_type("html");
    $this->__view->set_body('infos', 'index.tpl');
    //$this->__view->set_css(array('default.css'));
    $this->__view->attach_data(array("title" => "Infos Page"));

    return $this->display();
  }

}
