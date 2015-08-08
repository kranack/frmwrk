There is <?php echo count($this->__data['modules_db']); ?>/<?php echo count($this->__data['modules_list']); ?> modules enabled.

<?php foreach ($this->__data['modules_list'] as $module): ?>
  <p> <?php echo $module; echo in_array($module, $this->__data['modules_db']) ? ' enabled' : ' disabled'?> </p>
<?php endforeach; ?>
