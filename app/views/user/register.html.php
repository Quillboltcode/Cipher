<?php

require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';

?>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Register</h1>
        <form action="<?php echo URLROOT; ?>/user/register" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
        </form>
    </div>
<?php if(!empty($errors)) : ?>
    <div class="container mx-auto">
        <ul>
            <?php foreach($errors as $error): ?>
                <li class="text-red-500"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php require_once 'app/views/partials/footer.php'; ?>
