<?php

class ContactController extends Controller {

  public function index($args) {
    $form = new Modules\Form\Form('GET', '.');
    $input = new Modules\Form\Input('test');
    $label = new Modules\Form\Label('Label for test field', 'test');
    $button = new Modules\Form\Button('button', 'Click me', 'submit', 'coolButton', 'coolClassForAButton');
    $form->add_obj($input->attach($label));
    $form->add_obj($button);

    /* View setup */
    $datas = array(
      'title' => 'Contact Page',
      'form' => $form->display()
    );
    $this->__view->set_content_type("html");
    $this->__view->set_body('contact', 'index.tpl')->set_template('default.tpl');
    $this->__view->attach_data($datas);

    return $this->display();
  }

}
