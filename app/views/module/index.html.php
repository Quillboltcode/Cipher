<?php

require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';
?>
<?php
$data = json_decode(json_encode($data), true);

?>
<table class="table-auto w-full">
  <thead>
    <tr>
      <th class="px-4 py-2">Module Name</th>
      <th class="px-4 py-2">Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $module) : ?>
      <tr>
        <td class="border px-4 py-2"><?= $module['module_name'] ?></td>
        <td class="border px-4 py-2"><?= $module['description'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
require_once 'app/views/partials/footer.php';    
?>