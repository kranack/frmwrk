<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->__data->title; ?></title>
    <meta charset="<?php echo $this->__data->charset; ?>">
    <?php foreach ($this->__data->css as $css): ?>
      <?php echo $css; ?>
    <?php endforeach; ?>
  </head>
  <body>
    <?php echo $this->__data->body; ?>
  </body>
</html>
