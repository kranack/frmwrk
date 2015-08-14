<?php

class ContactController extends Controller {

  public function index($args) {
    /*$form = new Modules\Forms\Form('GET', '.');
    $input = new Modules\Forms\Input('test');
    $label = new Modules\Forms\Label('Label for test field', 'test');
    $button = new Modules\Forms\Button('button', 'Click me', 'submit', 'coolButton', 'coolClassForAButton');
    $form->add_obj($label)->add_obj($input)->add_obj($button);
    $form_render = $form->display();*/

    $form = new \Modules\Forms\Form('GET', '.');
    $form_render = $form->display();

    $render = '<form class="ui form" type="GET" action=".">' . "\n" . '</form>';

    var_dump(trim($form_render));
    var_dump(trim($render));
    var_dump(strcmp(trim($form_render),trim($render)));
    print_r($render);
  }

}
