<?php

  namespace Tests;

  if (!defined ('ROOT_DIR'))
    define ('ROOT_DIR', dirname(dirname(__DIR__)), true);

  require_once (ROOT_DIR . "/app/framework/modules/Form/class/Form.php");
  require_once (ROOT_DIR . "/app/framework/modules/Form/class/Element.php");
  require_once (ROOT_DIR . "/app/framework/modules/Form/class/Label.php");
  require_once (ROOT_DIR . "/app/framework/modules/Form/class/Input.php");
  require_once (ROOT_DIR . "/app/framework/modules/Form/class/TextArea.php");
  require_once (ROOT_DIR . "/app/framework/modules/Form/class/Button.php");
  require_once (ROOT_DIR . "/app/framework/modules/Form/class/Option.php");
  require_once (ROOT_DIR . "/app/framework/modules/Form/class/Select.php");

class FormTest extends \PHPUnit_Framework_TestCase {

  public function testCreateGetForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $form_render = $form->display();

    $render = '<form class="ui form" method="GET" action=".">' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testCreatePostForm () {
    $form = new \Modules\Form\Form('POST', '.');
    $form_render = $form->display();

    $render = '<form class="ui form" method="POST" action=".">'. "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddInputToForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $input = new \Modules\Form\Input('test');
    $form_render = $form->add_obj($input)->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<div class="field">'. "\n" .'<input type="text" name="test">'. "\n" .'</div>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddInputPlaceholderToForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $input = new \Modules\Form\Input('test');
    $input->placeholder('test');
    $form_render = $form->add_obj($input)->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<div class="field">'. "\n" .'<input type="text" placeholder="test" name="test">'. "\n" .'</div>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddInputLabelToForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $input = new \Modules\Form\Input('test');
    $label = new \Modules\Form\Label('Label for test field', 'test');
    $form_render = $form->add_obj($label)->add_obj($input)->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<label for="test">Label for test field</label>'. "\n" .'<div class="field">'. "\n" .'<input type="text" name="test">'. "\n" .'</div>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddButtonToForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $button = new \Modules\Form\Button('test', 'Send');
    $form_render = $form->add_obj($button)->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<button type="submit" name="test" class="ui submit button">Send</button>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddSelectToForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $select = new \Modules\Form\Select('test');
    $form_render = $form->add_obj($select)->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<select name="test">'. "\n" .'</select>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddSelectionOptionToForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $select = new \Modules\Form\Select('test');
    $opt = new \Modules\Form\Option('choice1', '1');
    $select->add($opt);
    $form_render = $form->add_obj($select)->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<select name="test">'. "\n    " .'<option value="1">choice1</option>'. "\n" .'</select>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddTextAreaToForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $textarea = new \Modules\Form\TextArea('test');
    $form_render = $form->add_obj($textarea)->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<textarea name="test"></textarea>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testCreateCompleteForm () {
    $form = new \Modules\Form\Form('GET', '.');
    $textarea = new \Modules\Form\TextArea('test');
    $input = new \Modules\Form\Input('test');
    $input->placeholder('test');
    $button = new \Modules\Form\Button('test', 'Send');
    $form->add_obj($input)->add_obj($textarea)->add_obj($button);
    $form_render = $form->display();

    $render = '<form class="ui form" method="GET" action=".">'. "\n" .'<div class="field">'. "\n" .'<input type="text" placeholder="test" name="test">'. "\n" .'</div>'. "\n" .'<textarea name="test"></textarea>'. "\n" .'<button type="submit" name="test" class="ui submit button">Send</button>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

}
