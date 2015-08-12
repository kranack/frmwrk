<?php if (isset($this->__data['infos'])): ?>

  <h3> <?= $this->__data['infos']['name']; ?> </h3>

  <p> <?= $this->__data['infos']['description']; ?> </p>

  <p> Created by <?= $this->__data['infos']['author']; ?> </p>

  <p> Current status : <?= $this->__data['status']; ?> </p>

  <p> <a href="/admin/modules"> Return to modules list </a> </p>

<?php endif; ?>
