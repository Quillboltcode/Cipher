<?php

require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';
?>
<?php $user = json_decode(json_encode($data),true);
var_dump($user);
?>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10 p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Left Side: Avatar and Basic Info -->
            <div class="text-center md:col-span-1">
                <img class="w-32 h-32 rounded-full mx-auto" 
                <?php if(isset($user['user']['avatar'])): ?>
                    src="<?php echo UPLOAD_PATH.$user['user']['avatar']; ?>"
                <?php else: ?>
                src="https://via.placeholder.com/150" 
                <?php endif; ?>    
                alt="User Avatar">
                <h2 class="text-2xl font-semibold mt-4"><?php echo $user['user']['username']; ?></h2>
                <p class="text-gray-600"><?php echo $user['user']['email']; ?></p>
                <p class="text-gray-600">Member since 
                    <?php // format to dd/mm/yyyy 
                    echo date("d/m/Y", strtotime($user['user']['created_at'])); ?></p>
            </div>

            <!-- Right Side: User Details -->
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div class="flex items-center justify-between py-2 border-b">
                        <span class="text-gray-600">Name</span>
                        <span class="font-semibold"><?php echo $user['user']['username']; ?></span>
                    </div>
                    <!-- Role -->
                    <div class="flex items-center justify-between py-2 border-b">
                        <span class="text-gray-600">Role</span>
                        <span class="font-semibold"><?php if ($user['user']['role_id']==1){echo 'Admin';}else{echo 'User';}?></span>
                    </div>
                    <!-- Email -->
                    <div class="flex items-center justify-between py-2 border-b">
                        <span class="text-gray-600">Email</span>
                        <span class="font-semibold"><?php echo $user['user']['email']; ?></span>
                    </div>
                    <!-- Email Verification -->
                    <div class="flex items-center justify-between py-2 border-b">
                        <span class="text-gray-600">Question Asked</span>
                        <span class="font-semibold text-orange-500"><?php echo $user['question_count']['count']; ?></span>
                    </div>
                    <!-- Contact -->
                    <div class="flex items-center justify-between py-2 border-b">
                        <span class="text-gray-600">Answer count</span>
                        <span class="font-semibold"><?php echo $user['answer_count']['count']; ?></span>
                    </div>
                    <!-- Status -->
                    <div class="flex items-center justify-between py-2 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="font-semibold text-green-500">Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>




<div class="mt-3 flex justify-center mb-3">
  <a href="<?php echo URLROOT.'/user/edit/'; ?>">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="button">Update Profile</button>
  </a>
  <a href="<?php echo URLROOT.'/user/delete/'.$user['user']['user_id']; ?>">
    <button class="bg-red-300 hover:bg-red-500 text-gray-900 font-bold py-2 px-4 rounded ml-3" type="button">Delete Account</button>
  </a>
</div>



<?php
require_once 'app/views/partials/footer.php';    
?>
