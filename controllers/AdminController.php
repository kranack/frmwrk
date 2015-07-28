<?php

class AdminController extends Controller {

  public function index () {
    Session::start();
    if (Session::get('user') === null) {
      Tools::redirect('/admin/login');
    }

    $user = Session::get('user');

    if (UserModel::getRole($user) === "admin") {

    }

  }

  public function login () {

    $post = Tools::data();
    $success = '';
    $error = '';
    if (isset($post['login'])) {
      if (trim($post['adminpwd']) === '') {
        $error = 'Invalid password';
      }
    }

    /* Form creation */
    $form = new Modules\Forms\Form('POST', '/admin/login');
    $login = new Modules\Forms\Input('login');
    $login_label = new Modules\Forms\Label('Login', 'login');
    $pwd = new Modules\Forms\Input('adminpwd', 'password');
    $pwd_label = new Modules\Forms\Label('Password', 'adminpwd');
    $button = new Modules\Forms\Button('button', 'Connexion', 'submit');
    $form->add_obj($login->attach($login_label));
    $form->add_obj($pwd->attach($pwd_label))->add_obj($button);

    /* View setup */
    $datas = array(
      'title' => 'Login Admin',
      'form' => $form->display(),
      'form_return' => array(
        'error' => $error,
        'success' => $success
      )
    );
    $this->__view->set_content_type("html");
    $this->__view->set_body('admin', 'index.tpl');
    $this->__view->attach_data($datas);
    echo $this->__view->display();
  }

}
