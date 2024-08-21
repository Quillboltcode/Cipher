<?php

require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';
?>
<?php $user = json_decode(json_encode($data), true); 
// var_dump($user);
// echo $_SERVER['DOCUMENT_ROOT'];
?>

<form action="<?php echo URLROOT; ?>/user/edit" method="POST" class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10 p-8" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Left Side: Avatar and Basic Info -->
            <div class="text-center md:col-span-1">
                <img class="w-32 h-32 rounded-full mx-auto" 
                <?php if (isset($user['avatar'])): ?>
                    src="<?php echo UPLOAD_PATH. $user['avatar']; ?>"
                <?php else: ?>
                src="https://via.placeholder.com/150" 
                
                <?php endif; ?>
                alt="User Avatar">
                <!-- Avatar Upload -->
                <input class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-4" id="avatar" type="file" name="avatar">
                
                <h2 class="text-2xl font-semibold mt-4"><?php echo $user['username']; ?></h2>
                <p class="text-gray-600"><?php echo $user['email']; ?></p>
            </div>

            <!-- Right Side: User Details -->
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">User Name</label>
                        <input type="text" class="border border-gray-300 rounded-lg p-2 mt-1" value="<?php echo $user['username']; ?>" name="username">
                    </div>
                    <!-- Email -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Email</label>
                        <input type="email" class="border border-gray-300 rounded-lg p-2 mt-1" value="<?php echo $user['email']; ?>" name="email">
                    </div>

                <!-- Save Button -->
                <div class="text-center mt-6">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Changes
                    </button>
                </div>
            </div>
            </div>
        </div>
    </form>

<?php
require_once 'app/views/partials/footer.php';    
?>