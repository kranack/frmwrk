<?php

class AdminController extends Controller {

  /**
   * Dashboard view
   * Check if an user is logged
   * and if he is an admin : redirect to login page if failed.
   */
  public function index () {
    Tools::admin_logged();

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
        'error' => $error
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
    Tools::admin_logged();

    Session::destroy();

    Tools::redirect('/');
  }

  /**
   * Users statistic view
   *
   */
  public function users () {
    Tools::admin_logged();

    $db = Connections::get('user');

    $r = $db->fetchAll($db->select('user', array('username'))->statement);
    $datas = array(
      'title' => 'Admin Dashboard - Users statistics',
      'users' => $r
    );
    $this->__view->set_content_type('html');
    $this->__view->set_js (array('/views/static/js/script.js'));
    $this->__view->set_body('admin', 'bo/users.tpl');
    $this->__view->attach_data($datas);
    echo $this->__view->display();

    //var_dump(debug_backtrace());
  }

  public function add_admin () {
    Tools::admin_logged();

    $post = Tools::data();
    $error = '';
    $success = '';
    $form_return = array();
    if (!empty($post)) {
      if (isset($post['login'])) {
        if (trim($post['pwd']) === '') {
          $error = 'Invalid password';
        } else if (Tools::add_admin(trim($post['login']), trim($post['pwd']))) {
          $success = 'Admin added';
        } else {
          $error = 'Wrong password, BITCH !';
        }
      }
      /* Set return */
      $form_return = array(
        'error'   => $error,
        'success' => $success
      );
    }

    /* Form creation */
    $form = new Modules\Forms\Form('POST', '/admin/add_admin');
    $login = new Modules\Forms\Input('login');
    $login_label = new Modules\Forms\Label('Login', 'login');
    $pwd = new Modules\Forms\Input('pwd', 'password');
    $pwd_label = new Modules\Forms\Label('Password', 'pwd');
    $button = new Modules\Forms\Button('button', 'Add admin', 'submit');
    $form->add_obj($login->attach($login_label));
    $form->add_obj($pwd->attach($pwd_label))->add_obj($button);

    /* View setup */
    $datas = array(
      'title' => 'Admin Dashboard - Add an admin',
      'form' => $form->display()
    );
    $this->__view->set_content_type("html");
    $this->__view->set_body('admin', 'index.tpl');
    $this->__view->attach_data($datas);
    echo $this->__view->display();
  }

  public function modules () {
    Tools::admin_logged();

    $db = Connections::get('core');
    $modules = $db->fetchAll($db->select('core_modules')->statement);

    $datas = array(
      'title' => 'Admin Dashboard - Modules',
      'modules_db' => $modules,
      'modules_list' => Core::list_modules()
    );

    $this->__view->set_content_type('html');
    $this->__view->set_js (array('/views/static/js/script.js'));
    $this->__view->set_body('admin', 'bo/modules.tpl');
    $this->__view->attach_data($datas);
    echo $this->__view->display();
  }

}
