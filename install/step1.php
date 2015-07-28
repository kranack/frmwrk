<?php

  if (isset($_POST)) {

    if (isset($_POST['db_name'])) {
      $error = "";
      $success = "";

        if (trim($_POST['db_name']) != ''
            && trim($_POST['db_host']) != ''
            && trim($_POST['db_port']) != ''
            && trim($_POST['db_user']) != '') {

          /* PERMIT ROOT LOGIN WITHOUT PWD */
          if (isset($_POST['db_root_no_pwd'])
            || trim($_POST['db_pwd']) != '') {
              $db_config = array(
                'engine'    => $_POST['db_engine'],
                'host'       => $_POST['db_host'],
                'username'  => $_POST['db_user'],
                'password'   => $_POST['db_pwd'],
                'port'      => $_POST['db_port'],
                'database'  => $_POST['db_name']
              );

              require_once ('../core/Database.php');
              $sql = file_get_contents('./db.sql');

              $db = new Database($db_config);
              if (!$db->exec($sql)) {
                $values = array('install_date' => date('Y/m/d H:i:s'), 'status' => 1);
                if ($db->insert('core', $values) !== '') {
                  $success = "Database connection seems OK!";
                } else {
                  $error = "Well I can connect to your Database but I can't write on it! WTF BRO ?!";
                }
              } else {
                $error = "WOW! Your Database is dead :/";
              }

          } else {
            $error = "Checkout your password BRO !!!";
          }

        } else {
          $error = "Check your form BRO !!!";
        }
    }

  }

?>

<!DOCTYPE html>
<html>
<head>
  <title> Framework installation </title>
  <link rel="stylesheet" href="/vendor/semantic-ui/semantic.min.css">
  <style type="text/css">
    .addDatabase {
      color: green;
    }
    .addDatabase:hover {
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="ui fluid container">
    <h3> Install Database(s) </h3>
    <div class="ui divider"></div>
  </div>
  <div class="ui grid one column fluid container">
    <div id="databaseContainer" class="column">
      <?php
      if (isset($success)):
        if ($success !== ''):
          ?>
          <div class="ui success message">
            <div class="header">Form Success</div>
            <p><?php echo $success; ?></p>
            <p> <a href="../"> Enjoy your ride now </a></p>
          </div>
          <?php
        endif;
      endif;
      ?>
      <?php
      if (isset($error)):
        if ($error !== ''):
          ?>
          <div class="ui error message">
            <div class="header">Form Error</div>
            <p><?php echo $error; ?></p>
          </div>
          <?php
        endif;
      endif;
      ?>
      <form class="ui form" method="POST">
        <div id="db" class="database">
          <div class="field">
            <label> Choose your engine </label>
            <select id="chooseEngine" name="db_engine">
              <option value="mysql">Mysql</option>
              <option value="mariadb">Mariadb</option>
            </select>
          </div>
          <div class="field">
            <label> Database Name </label>
            <input type="text" name="db_name">
          </div>
          <div class="field">
            <label> Database Host </label>
            <input type="text" name="db_host" placeholder="localhost">
          </div>
          <div class="field">
            <label> Database Port </label>
            <input id="dbPort" type="text" name="db_port">
          </div>
          <div class="field">
            <label> Database User </label>
            <input type="text" name="db_user" placeholder="root">
          </div>
          <div class="field">
            <label> Database Password </label>
            <input type="password" name="db_pwd">
          </div>
          <div class="inline field">
            <label> Permit root login without password </label>
            <input type="checkbox" name="db_root_no_pwd">
          </div>
        </div>
        <button id="submitForm" class="ui submit button">Submit</button>
      </form>
    </div>
    <!--<div>
      Add a database
      <div id="addDatabase" class="addDatabase"><i class="plus icon"></i></div>
    </div>-->
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="install.js"></script>
</body>
</html>
