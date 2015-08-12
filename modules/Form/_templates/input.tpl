<div class="field">
<?php echo $this->_label->display(); ?>
<input type="<?php echo $this->_type; ?>" <?php echo (isset($this->_id)) ? 'id="' . $this->_id . '"' : ''; echo (isset($this->_class)) ? 'class="' . $this->_class . '"' : ''; echo (isset($this->_placeholder)) ? 'placeholder="' . $this->_placeholder . '"' : ''; ?> name="<?php echo $this->_name; ?>">
</div>
