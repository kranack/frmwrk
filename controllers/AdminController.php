<?php

class AdminController extends Controller {

  /**
   * Dashboard view
   * Check if an user is logged
   * and if he is an admin : redirect to login page if failed.
   */
  public function index () {
    Session::start();
    if (Session::get('user') === null) {
      Tools::redirect('/admin/login');
    }

    $user = Session::get('user');
    if (Tools::is_admin($user)) {
      // ADMIN VIEW
      $datas = array('title' => 'Admin Dashbord', 'user' => $user);
      $this->__view->set_content_type("html");
      $this->__view->set_body('admin', 'bo/index.tpl');
      $this->__view->attach_data($datas);
      echo $this->__view->display();
    }
  }

  /**
   * Login view
   * Check form values and try to login as an admin
   * Return errors if failed
   */
  public function login () {
    $post = Tools::data();
    $success = '';
    $error = '';
    $form_return = array();
    if (!empty($post)) {
      if (isset($post['login'])) {
        if (trim($post['adminpwd']) === '') {
          $error = 'Invalid password';
        } else if (Tools::is_admin(trim($post['login']), trim($post['adminpwd']))) {
          Session::start();
          Session::set('user', trim($post['login']));
          Tools::redirect('/admin');
        } else {
          $error = 'Wrong password, BITCH !';
        }
      }
      /* Set return */
      $form_return = array(
        'error' => $error,
        'success' => $success
      );
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
      'form_return' => $form_return
    );
    $this->__view->set_content_type("html");
    $this->__view->set_body('admin', 'index.tpl');
    $this->__view->attach_data($datas);
    echo $this->__view->display();
  }

  /**
   * Logout view
   * Unset the user value in the current session
   * and redirect to root.
   */
  public function logout () {
    Session::start();

    if (Session::get('user') !== null) {
      Session::destroy();
    }

    Tools::redirect('/');
  }

  /**
   * Users statistic view
   *
   */
  public function users () {
    Session::start();
    if (Session::get('user') === null) {
      Tools::redirect('/admin/login');
    }

    $db = Connections::get('user');

    $r = $db->fetchAll($db->select('user'));
    $datas = array(
      'title' => 'Admin Dashboard - Users statistics',
      'users' => $r
    );
    $this->__view->set_content_type('html');
    $this->__view->set_body('admin', 'bo/users.tpl');
    $this->__view->attach_data($datas);
    echo $this->__view->display();
  }


}
