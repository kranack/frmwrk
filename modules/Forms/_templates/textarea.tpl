<textarea <?php echo (isset($this->_id)) ? 'id="' . $this->_id . '"' : ''; echo (isset($this->_class)) ? 'class="' . $this->_class . '"' : ''; ?> name="<?php echo $this->_name; ?>"><?php echo (isset($this->_placeholder)) ? 'placeholder="' . $this->_placeholder . '"' : '';?></textarea>
