<?php

require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';
?>
<?php $user = json_decode(json_encode($data),true);

?>
<div class="max-w-md mx-auto p-4 bg-white rounded-md shadow-md">
  <h2 class="text-lg font-bold mb-4">User Information</h2>
  <div class="flex flex-wrap mb-4">
    <div class="w-full md:w-1/2 xl:w-1/3 p-4">
      <h3 class="text-sm font-bold mb-2">Username:</h3>
      <p class="text-gray-700"><?= $user['username'] ?></p>
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-4">
      <h3 class="text-sm font-bold mb-2">Email:</h3>
      <p class="text-gray-700"><?= $user['email']?></p>
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-4">
      <h3 class="text-sm font-bold mb-2">Joined on</h3>
      <p class="text-gray-700"><?= $user['created_at'] ?></p>
    </div>
    <div class="w-full md:w-1/2 xl:w-1-3 p-4">
      <h3 class="text-sm font-bold mb-2">Role:</h3>
      <p class="text-gray-700"><?php if ($user['role_id'] == 1) {echo 'Admin';} else {echo 'User';} ?></p> 
  </div>

  </div>
</div>

<div class="mt-3 flex justify-center">
  <a href="<?php echo URLROOT.'/user/edit/'.$user['user_id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Profile</a>
  <a href="<?php echo URLROOT.'/user/delete'.$user['user_id']; ?>" class="bg-orange-600 hover:bg-red-700 text-gray-900 font-bold py-2 px-4 rounded ml-3">Delete Account</a>
</div>

<?php
require_once 'app/views/partials/footer.php';    
?>
