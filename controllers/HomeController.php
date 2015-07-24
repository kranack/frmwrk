<?php

class HomeController extends Controller {

  public function index($args) {
    $this->__view->set_content_type("html");
    $this->__view->set_body('home', 'index.tpl');
    $this->__view->set_css(array('default.css'));
    $this->__view->attach_data(array("title" => "Home"));
    $this->__view->display();

    $form = new Modules\Forms\Form('GET', '.');
    $input = new Modules\Forms\Input('test');
    $label = new Modules\Forms\Label('Label for test field', 'test');
    $form_render = $form->add_obj($label)->add_obj($input)->display();
    $form_render = $form->display();
    print_r($form_render);
  }

  public function json() {
    $this->__view->set_content_type("json", "utf-8");
    $this->__view->attach_data(array("title" => "Test JSON"));
    print_r("{'name':'Damien'}");
  }

}
