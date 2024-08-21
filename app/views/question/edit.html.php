<?php require_once 'app/views/partials/head.php' ?>
<?php require_once 'app/views/partials/nav.php' ?>

<form action="<?= URLROOT ?>/question/edit/<?=$data['id']?>" method="post">
  <div class="max-w-md mx-auto p-4 bg-white rounded-md shadow-md">
    <h2 class="text-lg font-bold mb-4">Edit Question</h2>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" value="<?=htmlspecialchars($data['title'])?>" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
      <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="body" name="body" required><?=htmlspecialchars($data['body'])?></textarea>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="module_names">Module Names</label>
      <select multiple name="module_names[]" id="module_names" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
  <?php foreach($data['module'] as $moduleName) : ?>
    <option value="<?= $moduleName['module_name'] ?>"><?= $moduleName['module_name'] ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="image_path">Image</label>
      <input type="file" id="image_path" name="image_path">
    </div>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Save Changes</button>
  </div>
</form>

<?php require_once 'app/views/partials/footer.php' ?>