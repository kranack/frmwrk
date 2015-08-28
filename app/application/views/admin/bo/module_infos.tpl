<?php if (isset($this->__data['infos'])): ?>

  <h3> <?= $this->__data['infos']['name']; ?> </h3>

  <p> <?= $this->__data['infos']['description']; ?> </p>

  <p> Created by <?= $this->__data['infos']['author']; ?> </p>

  <p> Current status : <?= $this->__data['status']; ?> </p>

  <p> <a href="/admin/modules"> Return to modules list </a> <a href="#" id="addOpt" class="right"> Add an option </a> </p>

  <div id="opts_list">
    <table class="ui celled table" data-module="<?= $this->__data['name']; ?>">
      <thead>
        <tr>
          <th> Actions </th>
          <th> Option </th>
          <th> Value </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->__data['config']['opts'] as $opt): ?>
          <?php foreach ($opt as $o => $v): ?>
            <tr>
              <td> <a href="#" id="<?= $this->__data['name'];?>_<?= $o; ?>" class="delete"> <i class="trash outline icon"></i> </a> </td>
              <td class="editable"> <?= $o; ?> </td>
              <td class="editable"> <?= (gettype($v) === "boolean") ? ($v === false) ? 'false' : 'true' : $v ; ?> </td>
            </tr>
          <?php endforeach; ?>
        <?php endforeach; ?>
        <tr id="row" class="hidden"><td><a href="#" class="delete"><i class="trash outline icon"></i></a></td> <td class="editable"></td> <td class="editable"></td></tr>
      </tbody>
    </table>
  </div>

  <div id="input" class="hidden">
    <div class="ui small input">
      <input type="text">
    </div>
  </div>
<?php endif; ?>
