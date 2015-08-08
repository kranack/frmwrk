<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->__data->title; ?></title>
    <meta charset="<?php echo $this->__data->charset; ?>">
    <link rel="stylesheet" href="/vendor/semantic-ui/semantic.min.css">
    <?php foreach ($this->__data->css as $css): ?>
      <?php echo $css; ?>
    <?php endforeach; ?>
  </head>
  <body>
    <header>
      <div class="ui attached stackable menu">
        <div class="ui container">
          <a class="item" href="/">
            <i class="home icon"></i> Home
          </a>
          <a class="item" href="/user">
            <i class="users icon"></i> Users
          </a>
          <a class="item" href="">
            <i class="mail icon"></i> Json
          </a>
          <div class="ui simple dropdown item">
            More
            <i class="dropdown icon"></i>
            <div class="menu">
              <a class="item"><i class="edit icon"></i> Edit Profile</a>
              <a class="item"><i class="globe icon"></i> Choose Language</a>
              <a class="item"><i class="settings icon"></i> Account Settings</a>
            </div>
          </div>
          <div class="right item">
            <div class="ui input"><input placeholder="Search..." type="text"></div>
          </div>
          <div class="right item">
            <?php if (Session::status() !== PHP_SESSION_ACTIVE): Session::start(); endif; ?>
            <?php echo (Session::get('user') !== null) ? '<a href="/admin" class="item"> Access to dashboard </a><a href="/admin/logout" class="item"> Logout </a>' : '<a href="/admin/login" class="item"> Login </a>'; ?>
          </div>
        </div>
      </div>
    </header>
    <div class="ui container">
      <?php echo $this->__data->body; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <?php if (isset($this->__data->js)):
      foreach ($this->__data->js as $js): ?>
      <?php echo $js; ?>
    <?php endforeach;
    endif; ?>
  </body>
</html>
