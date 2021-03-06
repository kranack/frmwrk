<p> There <?= (count($this->__data['modules_list']) <= 1) ? 'is' : 'are';?> <?= count($this->__data['modules_list']); ?> modules available. </p>
<div id="modules_list">
  <table class="ui celled table">
    <thead>
      <tr>
        <th> Name </th>
        <th> Status </th>
      </tr>
    </thead>
    <tbody>
  <?php foreach ($this->__data['modules_list'] as $modulename => $m): ?>
    <tr>
      <td> <a href="/admin/modules/<?= $modulename; ?>"> <?= $modulename; ?></a> </td>
      <td>
        <div class="ui toggle checkbox">
          <input name="<?= $modulename; ?>_status" type="checkbox" <?= ($m->is_enabled()) ? 'checked="checked"' : '';?>>
          <label><?= $m->is_enabled() ? ' enabled' : ' disabled'?></label>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
    </tbody>
  </table>
</div>
