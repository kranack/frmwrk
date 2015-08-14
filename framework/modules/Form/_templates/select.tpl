<select <?php echo (isset($this->_id)) ? 'id="' . $this->_id . '"' : ''; (isset($this->_class)) ? 'class="' . $this->_class . '"' : ''; echo $this->_name; ?>>
<?php  foreach ($this->_opts as $opt) :
    $o = $opt->get(); ?>
    <option value="<?php echo $o->value; ?>"><?php echo $o->text; ?></option>
<?php  endforeach; ?>
</select>
