<?php
require_once './app/views/partials/head.php';
require_once './app/views/partials/nav.php';
?>

<?php $data = json_decode(json_encode($data), true);
// var_dump($data);
?>

<!-- Module Table -->
<table class="table-auto w-full">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">Module Name</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Function</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['modules'] as $item) { ?>
            <tr>
                <form action="<?= URLROOT . '/admin/edit/' . $item['module_id'] ?>" method="post">
                    <input type="hidden" class="w-full" name="module_id" value="<?php echo $item['module_id'] ?>">
                    <td class="border px-4 py-2">
                        <input type="text" name="module_name" value="<?php echo $item['module_name']; ?>" required>
                    </td>
                    <td class="border px-4 py-2">
                        <input type="text" class="w-full" name="description" value="<?php echo $item['description']; ?>"
                            required>
                    </td>
                    <td class="border px-4 py-2">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                        <form action="<?= URLROOT . '/admin/delete/' . $item['module_id'] ?>" method="post"
                            class="inline-block">
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                    </td>
                </form>

            
        <?php } ?>
        <!-- Create a form to create module -->

        </tr>
        <form action="<?= URLROOT . '/admin/createmodule' ?>" method="post">
            <td class="border px-4 py-2">
                <input type="text" name="module_name" required>
            </td>
            <td class="border px-4 py-2">
                <input type="text" class="w-full" name="description" required>
            </td>
            <td class="border px-4 py-2">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
            </td>
        
        </form>
    </tbody>
</table>
<!-- Question table-->
<table class="table-auto w-full">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">Question ID</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['questions'] as $question) { ?>
            <tr>
                <td class="border px-4 py-2"><?php echo $question['question_id']; ?></td>
                <td class="border px-4 py-2"><?php echo $question['title']; ?></td>
                <td class="border px-4 py-2">
                    <form action="<?= URLROOT . '/admin/deletequestion/' . $question['question_id'] ?>" method="post">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- User Table -->
<table class="table-auto w-full">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">User ID</th>
            <th class="px-4 py-2">Username</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['user'] as $user) { ?>
            <tr>
                <td class="border px-4 py-2"><?php echo $user['user_id']; ?></td>
                <td class="border px-4 py-2"><?php echo $user['username']; ?></td>
                <td class="border px-4 py-2">
                    <form action="<?= URLROOT . '/admin/deleteuser/' . $user['user_id'] ?>" method="post">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once './app/views/partials/footer.php'; ?>