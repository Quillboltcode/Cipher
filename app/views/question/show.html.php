<?php
require_once 'app/views/partials/head.php';

require_once 'app/views/partials/nav.php';
?>
<!--debug -->
<?php

$array_data = json_decode(json_encode($data), true);
var_dump($array_data['question']);
// var_dump($array_data['comment']);
// var_dump($array_data['answer']);
?>


<div class="container mx-auto mt-10 p-6 bg-white rounded shadow">
  <!-- Question Title -->
  <h1 class="text-2xl font-semibold mb-4"><?= htmlspecialchars($array_data['question']['title']) ?></h1>

  <div class="flex space-x-6">
    <!-- Vote Section -->
    <div class="text-center">
      <form action="<?= URLROOT ?>/question/vote/<?= $array_data['question']['question_id'] ?>" method="post">
        <input type="hidden" id="vote_type" name="vote_type" value="">
        <button id="question_upvote" class="text-gray-600 hover:text-green-600"
          onclick="document.getElementById('vote_type').value='upvote'">▲</button>
        <div class="text-green-600 font-bold"><?= htmlspecialchars($array_data['question']['upvotes']) ?></div>
        <button id="question_downvote" class="text-gray-600 hover:text-red-600"
          onclick="document.getElementById('vote_type').value='downvote'">▼</button>
        <div class="text-red-600"><?= htmlspecialchars($array_data['question']['downvotes']) ?></div>
      </form>
    </div>

    <!-- Question Content -->
    <div class="flex-grow">
      <p class="mb-4">
        <?= htmlspecialchars($array_data['question']['body']) ?>
        <br>
        <?php if (!empty($array_data['question']['image_path'])): ?>
          
        <img src="<?= UPLOAD_PATH.htmlspecialchars($array_data['question']['image_path']) ?>"
          alt="<?= htmlspecialchars($array_data['question']['image_path']) ?>" class="">
        <?php endif; ?>
      </p>

      <!-- Modules -->
      <div class="flex space-x-2 mb-4">
        <?php if ($array_data['question']['module_names'] == ''): ?>
          <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded">No modules</span>
        <?php else: ?>
          <?php $moduleNames = explode(',', $array_data['question']['module_names']); ?>
          <?php foreach ($moduleNames as $moduleName): ?>
            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded"><?= htmlspecialchars($moduleName) ?></span>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Actions -->
      <div class="flex space-x-4 text-sm text-gray-600">
        <a href="<?= URLROOT ?>/question/edit/<?= htmlspecialchars($array_data['question']['question_id']) ?>"
          class="hover:underline">edit</a>
        <a href="<?= URLROOT ?>/question/delete/<?= htmlspecialchars($array_data['question']['question_id']) ?>"
          class="hover:underline">close</a>
        <a href="<?= URLROOT ?>/comment/create/<?= htmlspecialchars($array_data['question']['question_id']) ?>"
          class="hover:underline">add comment</a>
        <a href="<?= URLROOT ?>/answer/create/<?= htmlspecialchars($array_data['question']['question_id']) ?>"
          class="hover:underline">add answer</a>
      </div>
    </div>

    <!-- User Info -->
    <div class="text-sm text-gray-600 bg-gray-50 p-4 rounded">
      <div class="mb-2"><?= htmlspecialchars($array_data['question']['created_at']) ?></div>
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-gray-300 rounded-full">
            <img class="w-full h-full rounded-full" src="<?= UPLOAD_PATH.htmlspecialchars($array_data['question']['avatar']) ?>" alt="User Avatar">
          </div> <!-- Placeholder for user avatar -->
            <div>
              <div class="font-semibold"><?= htmlspecialchars($array_data['question']['username']) ?></div>
            </div>
        </div>
      </div>
    </div>

    <!-- Comment Section -->
    <div class="mt-6 border-t pt-4">
      <?php foreach ($array_data['comment'] as $comment): ?>

        <div class="mb-2 text-sm flex justify-between">
          <span class="text-lg text-gray-600 font-bold"><?= htmlspecialchars($comment['body']) ?></span>
          <span
            class="text-sm text-gray-400"><?= htmlspecialchars($comment['created_at']) . ' by ' . htmlspecialchars($comment['username']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>


    <div class="container mx-auto mt-10 p-6 bg-white rounded shadow">
      <!-- Answer Title -->
      <!-- <h1 class="text-2xl font-semibold mb-4"><?= htmlspecialchars($array_data['answer_title']) ?></h1> -->

      <?php foreach ($array_data['answer'] as $answer): ?>
        <div class="flex space-x-6">
          <!-- Vote Section -->
          <div class="text-center">
      <form action="<?= URLROOT ?>/answer/vote/<?= $answer['answer_id'] ?>" method="post">
        <input type="hidden" id="vote_type_answer<?=htmlspecialchars($answer['answer_id'])?>" name="vote_type" value="">
        <button id="question_upvote" class="text-gray-600 hover:text-green-600"
          onclick="document.getElementById('vote_type_answer<?=htmlspecialchars($answer['answer_id']) ?>').value='upvote'">▲</button>
        <div class="text-green-600 font-bold"><?= htmlspecialchars($answer['upvotes']) ?></div>
        <button id="question_downvote" class="text-gray-600 hover:text-red-600"
          onclick="document.getElementById('vote_type_answer<?=htmlspecialchars($answer['answer_id']) ?>').value='downvote'">▼</button>
        <div class="text-red-600"><?= htmlspecialchars($answer['downvotes']) ?></div>
      </form>
    </div>

          <!-- Answer Content -->
          <div class="flex-grow">
            <p class="mb-4">
              <?= htmlspecialchars($answer['body']) ?>
            </p>

            <!-- Actions -->
            <div class="flex space-x-4 text-sm text-gray-600">
              <a href="<?= URLROOT ?>/answer/edit/<?= htmlspecialchars($answer['answer_id']) ?>"
                class="hover:underline">edit</a>
              <a href="<?= URLROOT ?>/answer/delete/<?= htmlspecialchars($answer['answer_id']) ?>"
                class="hover:underline">delete</a>
            </div>
          </div>

          <!-- User Info -->
          <div class="flex-shrink-0">
            <img src="<?php if (!empty($answer['avatar'])) {
              echo UPLOAD_PATH . htmlspecialchars($answer['avatar']);
            } else {
              echo 'https://via.placeholder.com/24';
            }
            ?>
                
                " alt="User Avatar" class="w-10 h-10 rounded-full">
            <span class="" <span class="text-sm text-gray-600"><?= htmlspecialchars($answer['username']) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


    <?php require_once 'app/views/partials/footer.php'; ?>