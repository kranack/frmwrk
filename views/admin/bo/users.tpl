There is <?= count($this->__data['users']); ?> users
<table>
<?php foreach ($this->__data['users'] as $user): ?>
  <tr>
    <td> <?= $user->username; ?> </td>
  </tr>
<?php endforeach; ?>
</table>
