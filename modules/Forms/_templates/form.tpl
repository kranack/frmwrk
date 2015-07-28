<form class="ui form" <?php echo (isset($this->_type)) ? 'method="' . $this->_type . '"' : ''; echo (isset($this->_action)) ? ' action="' . $this->_action . '"' : ''; ?>>
<?php
  foreach ($this->_objs as $type):
    foreach ($type as $t):
      echo $t->display();
    endforeach;
  endforeach;
?></form>
