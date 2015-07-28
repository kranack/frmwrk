<?php if (isset($this->__data['form_return']['error'])): ?>
  <div class="ui error message">
    <div class="header">Form Error</div>
    <p><?php echo $this->__data['form_return']['error']; ?></p>
  </div>
<?php  endif; ?>
<?php echo $this->__data['form']; ?>
