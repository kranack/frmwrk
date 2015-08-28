<?php

class ContactController extends Controller {

  public function index($args) {
    /*$form = new Modules\Form\Form('GET', '.');
    $input = new Modules\Form\Input('test');
    $label = new Modules\Form\Label('Label for test field', 'test');
    $button = new Modules\Form\Button('button', 'Click me', 'submit', 'coolButton', 'coolClassForAButton');
    $form->add_obj($input->attach($label));
    $form->add_obj($button);*/

    /* View setup */
    /*$datas = array(
      'title' => 'Contact Page',
      'form' => $form->display()
    );
    $this->__view->set_content_type("html");
    $this->__view->set_body('contact', 'index.tpl')->set_template('default.tpl');
    $this->__view->attach_data($datas);

    return $this->display();*/


    $form = new \Modules\Form\Form('GET', '.');
    $textarea = new \Modules\Form\TextArea('test');
    $input = new \Modules\Form\Input('test');
    $input->placeholder('test');
    $button = new \Modules\Form\Button('test', 'Send');
    $form->add_obj($input)->add_obj($textarea)->add_obj($button);
    $form_render = $form->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<div class="field">'. "\n" .'<input type="text" placeholder="test" name="test">'. "\n" .'</div>'. "\n" .'<textarea name="test"></textarea>'. "\n" .'<button type="submit" name="test" class="ui submit button">Send</button>' . "\n" . '</form>';
    var_dump(trim($form_render));
    var_dump(trim($render));
    var_dump(trim($form_render) === trim($render));
  }

}
