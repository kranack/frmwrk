<?php if (isset($this->__data['infos'])): ?>

  <h3> <?= $this->__data['infos']['name']; ?> </h3>

  <p> <?= $this->__data['infos']['description']; ?> </p>

  <p> Created by <?= $this->__data['infos']['author']; ?> </p>

  <p> Current status : <?= $this->__data['status']; ?> </p>

  <p> <a href="/admin/modules"> Return to modules list </a> </p>

  <div id="opts_list">
    <table class="ui celled table">
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
              <td> <a id="<?= $this->__data['name'];?>_<?= $o; ?>" class="delete" href="#"> <i class="trash outline icon"></i> </a> </td>
              <td> <?= $o; ?> </td>
              <td> <?= (gettype($v) === "boolean") ? ($v === false) ? 'false' : 'true' : $v ; ?> </td>
            </tr>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
