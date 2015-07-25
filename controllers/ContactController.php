<?php

class ContactController extends Controller {

  public function index($args) {
    $form = new Modules\Forms\Form('GET', '.');
    $input = new Modules\Forms\Input('test');
    $label = new Modules\Forms\Label('Label for test field', 'test');
    $form_render = $form->add_obj($label)->add_obj($input)->display();
    $form_render = $form->display();
    print_r($form_render);
  }

}
