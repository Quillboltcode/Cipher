<?php
require_once 'app/views/partials/head.php';

require_once 'app/views/partials/nav.php';
?>

<?php

$array_data = json_decode(json_encode($data), true);
// var_dump($array_data);
var_dump($array_data['question']);
?>


<div class="container mx-auto mt-10 p-6 bg-white rounded shadow">
  <!-- Question Title -->
  <h1 class="text-2xl font-semibold mb-4"><?=htmlspecialchars($array_data['question']['title'])?></h1>

  <div class="flex space-x-6">
    <!-- Vote Section -->
    <div class="text-center">
      <button id="question_upvote" class="text-gray-600 hover:text-green-600">▲</button>
      <div class="text-green-600 font-bold"><?=htmlspecialchars($array_data['question']['upvotes'])?></div>
      <button id="question_downvote" class="text-gray-600 hover:text-red-600">▼</button>
      <div class="text-red-600"><?=htmlspecialchars($array_data['question']['downvotes'])?></div>
    </div>

    <!-- Question Content -->
    <div class="flex-grow">
      <p class="mb-4">
        <?=htmlspecialchars($array_data['question']['body'])?>
        <br>
        <?=htmlspecialchars($array_data['question']['body'])?>
      </p>

      <!-- Modules -->
      <div class="flex space-x-2 mb-4">
        <?php if ($array_data['question']['module_names'] == '') : ?>
          <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded">No modules</span>
        <?php else: ?>
        <?php $moduleNames = explode(',', $array_data['question']['module_names']); ?>
        <?php foreach ($moduleNames as $moduleName) : ?>
          <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded"><?=htmlspecialchars($moduleName)?></span>
        <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Actions -->
      <div class="flex space-x-4 text-sm text-gray-600">
        <a href="<?=URLROOT?>/question/edit/<?=htmlspecialchars($array_data['question']['question_id'])?>" class="hover:underline">edit</a>
        <a href="<?=URLROOT?>/question/delete/<?=htmlspecialchars($array_data['question']['question_id'])?>" class="hover:underline">close</a>
        <a href="<?=URLROOT?>/question/comment/question/<?=htmlspecialchars($array_data['question']['question_id'])?>" class="hover:underline">add comment</a>
      </div>
    </div>

    <!-- User Info -->
    <div class="text-sm text-gray-600 bg-gray-50 p-4 rounded">
      <div class="mb-2"><?=htmlspecialchars($array_data['question']['created_at'])?></div>
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-gray-300 rounded-full"></div> <!-- Placeholder for user avatar -->
        <div>
          <div class="font-semibold"><?=htmlspecialchars($array_data['question']['username'])?></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Comment Section -->
  <div class="mt-6 border-t pt-4">
    <div class="mb-2 text-sm text-gray-700">
      1. You need to install a PHP expansion board in a spare ISA slot of your server. Then configure Apache with the
      same IRQ as the DIP switches on the PHP board.
      <span class="text-gray-500">– Jonathon Reinhart 5 mins ago</span>
    </div>
    <a href="#" class="text-blue-600 text-sm hover:underline">add comment</a>
  </div>
</div>


<div class="container mx-auto mt-10 p-6 bg-white rounded shadow">
    <!-- Answer Title -->
    <!-- <h1 class="text-2xl font-semibold mb-4"><?=htmlspecialchars($array_data['answer_title'])?></h1> -->

    <?php foreach ($array_data['answer'] as $answer) : ?>
        <div class="flex space-x-6">
            <!-- Vote Section -->
            <div class="text-center">
                <button id="answer_upvote" class="text-gray-600 hover:text-green-600">▲</button>
                <div class="text-green-600 font-bold"><?=htmlspecialchars($answer['upvotes'])?></div>
                <button id="answer_downvote" class="text-gray-600 hover:text-red-600">▼</button>
                <div class="text-red-600"><?=htmlspecialchars($answer['downvotes'])?></div>
            </div>

            <!-- Answer Content -->
            <div class="flex-grow">
                <p class="mb-4">
                    <?=htmlspecialchars($answer['body'])?>
                </p>

                <!-- Actions -->
                <div class="flex space-x-4 text-sm text-gray-600">
                    <a href="<?=URLROOT?>/answer/edit/<?=htmlspecialchars($answer['answer_id'])?>" class="hover:underline">edit</a>
                    <a href="<?=URLROOT?>/answer/delete/<?=htmlspecialchars($answer['answer_id'])?>" class="hover:underline">delete</a>
                </div>
            </div>

            <!-- User Info -->
            <div class="flex-shrink-0">
                <img src="<?php if (!empty($answer['image_path'])) {
                    echo htmlspecialchars($answer['image_path']);
                  }else {
                      echo 'https://via.placeholder.com/24';
                    }
                ?>
                
                " alt="User Avatar" class="w-10 h-10 rounded-full">
                <span class=""
                <span class="text-sm text-gray-600"><?=htmlspecialchars($answer['username'])?></span>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php require_once 'app/views/partials/footer.php'; ?>