<?php

  namespace Tests;

  require_once ("/modules/Forms/class/Form.php");
  require_once ("/modules/Forms/class/Element.php");
  require_once ("/modules/Forms/class/Label.php");
  require_once ("/modules/Forms/class/Input.php");
  require_once ("/modules/Forms/class/TextArea.php");
  require_once ("/modules/Forms/class/Button.php");
  require_once ("/modules/Forms/class/Option.php");
  require_once ("/modules/Forms/class/Select.php");

class FormTest extends \PHPUnit_Framework_TestCase {

  public function testCreateGetForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $form_render = $form->display();

    $render = '<form class="ui form" method="GET" action=".">' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testCreatePostForm () {
    $form = new \Modules\Forms\Form('POST', '.');
    $form_render = $form->display();

    $render = '<form class="ui form" method="POST" action=".">'. "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddInputToForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $input = new \Modules\Forms\Input('test');
    $form_render = $form->add_obj($input)->display();

    $render = '<form method="GET" action="."><input type="text" name="test" >' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddInputPlaceholderToForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $input = new \Modules\Forms\Input('test');
    $input->placeholder('test');
    $form_render = $form->add_obj($input)->display();

    $render = '<form method="GET" action="."><input type="text" placeholder="test" name="test" >' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddInputLabelToForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $input = new \Modules\Forms\Input('test');
    $label = new \Modules\Forms\Label('Label for test field', 'test');
    $form_render = $form->add_obj($label)->add_obj($input)->display();

    $render = '<form method="GET" action="."><label for="test" >Label for test field</label><input type="text" name="test" >' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddButtonToForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $button = new \Modules\Forms\Button('test', 'Send');
    $form_render = $form->add_obj($button)->display();

    $render = '<form method="GET" action="."><button type="submit" name="test" >Send</button>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddSelectToForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $select = new \Modules\Forms\Select('test');
    $form_render = $form->add_obj($select)->display();

    $render = '<form method="GET" action="."><select name="test" ></select>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddSelectionOptionToForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $select = new \Modules\Forms\Select('test');
    $opt = new \Modules\Forms\Option('choice1', '1');
    $select->add($opt);
    $form_render = $form->add_obj($select)->display();

    $render = '<form method="GET" action="."><select name="test" ><option value="1">choice1</option></select>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testAddTextAreaToForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $textarea = new \Modules\Forms\TextArea('test');
    $form_render = $form->add_obj($textarea)->display();

    $render = '<form method="GET" action="."><textarea name="test" ></textarea>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

  public function testCreateCompleteForm () {
    $form = new \Modules\Forms\Form('GET', '.');
    $textarea = new \Modules\Forms\TextArea('test');
    $input = new \Modules\Forms\Input('test');
    $input->placeholder('test');
    $button = new \Modules\Forms\Button('test', 'Send');
    $form->add_obj($input)->add_obj($textarea)->add_obj($button);
    $form_render = $form->display();

    $render = '<form class="ui form" method="GET" action="."><input type="text" placeholder="test" name="test" ><textarea name="test" ></textarea><button type="submit" name="test" >Send</button>' . "\n" . '</form>';
    $this->assertEquals(trim($render), trim($form_render));
  }

}
