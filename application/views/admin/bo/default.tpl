<!DOCTYPE html>
<html>
<head>
  <title><?php echo $this->__data->title; ?></title>
  <meta charset="<?php echo $this->__data->charset; ?>">
  <link rel="stylesheet" href="/css/semantic-ui/semantic.min.css">
  <link rel="stylesheet" href="/css/admin/default.css">
  <?php foreach ($this->__data->css as $css): ?>
    <?php echo $css; ?>
  <?php endforeach; ?>
</head>
<body>
  <div class="ui top attached demo menu">
    <a class="item"><i class="sidebar icon"></i> Menu </a>
  </div>
  <div class="ui bottom attached segment pushable">
    <div style="" class="ui inverted labeled icon left inline vertical sidebar menu">
      <a class="item" href="/" ><i class="home icon"></i> Home </a>
      <a class="item" href="/admin/modules" ><i class="block layout icon"></i> Modules </a>
      <a class="item" href="/admin/users" ><i class="smile icon"></i> Users </a>
      <a class="item" href="/admin/add_admin" ><i class="calendar icon"></i> Add admin </a>
      <a class="item" href="/admin/logout" > Logout </a>
    </div>
    <div class="pusher">
      <div class="ui container">
        <?php echo $this->__data->body; ?>
      </div>
    </div>
  </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <script src="/js/semantic-ui/semantic.min.js"></script>
    <script src="/js/admin.js"></script>
    <?php if (isset($this->__data->js)):
      foreach ($this->__data->js as $js): ?>
      <?php echo $js; ?>
    <?php endforeach;
    endif; ?>
  </body>
  </html>
