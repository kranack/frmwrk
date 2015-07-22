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
        </div>
      </div>
    </header>
    <div class="ui container">
      <?php echo $this->__data->body; ?>
    </div>
  </body>
</html>
