<?php

require_once 'partials/head.php';
require_once 'partials/nav.php';
?>


<div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Login</h1>
        <form action="<?php echo URLROOT; ?>/users/login" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
        </form>
    </div>


<?php
require_once 'partials/footer.php';    
?>

