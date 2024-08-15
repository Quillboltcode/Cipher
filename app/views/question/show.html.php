<?php
require_once 'app/views/partials/head.php';

require_once 'app/views/partials/nav.php';
?>

<?php

$array_data = json_decode(json_encode($data), true);
var_dump($array_data);
?>
<div class="flex items-start">
  <div class="flex-shrink-0">
    <div class="inline-block relative">
      <div class="relative w-16 h-16 rounded-full overflow-hidden">
        <img class="absolute top-0 left-0 w-full h-full bg-cover object-fit object-cover" src="https://picsum.photos/id/646/200/200" alt="Profile picture">
        <div class="absolute top-0 left-0 w-full h-full rounded-full shadow-inner"></div>
      </div>
      <svg class="fill-current text-white bg-green-600 rounded-full p-1 absolute bottom-0 right-0 w-6 h-6 -mx-1 -my-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M19 11a7.5 7.5 0 0 1-3.5 5.94L10 20l-5.5-3.06A7.5 7.5 0 0 1 1 11V3c3.38 0 6.5-1.12 9-3 2.5 1.89 5.62 3 9 3v8zm-9 1.08l2.92 2.04-1.03-3.41 2.84-2.15-3.56-.08L10 5.12 8.83 8.48l-3.56.08L8.1 10.7l-1.03 3.4L10 12.09z"/>
      </svg>
    </div>
  </div>
  <div class="ml-6">
    <p class="flex items-baseline">
      <span class="text-gray-600 font-bold"><?= $array_data['question']['username'] ?></span>
    </p>


    <div class="mt-3 ">
      <span class="font-bold"><?= $array_data['question']['title'] ?></span>
      <p class="mt-1"><?= $array_data['question']['body'] ?></p>
      <?php if ($array_data['question']['image_path']) { ?>
    <div class="mt-3">
      <img src="<?= URLROOT . '/uploads/' . $array_data['question']['image_path'] ?>" alt="Question Image" class="w-full h-auto object-cover object-center">
    </div>
  <?php } ?>
  <div class="bg-orange-300 hover:bg-orange-700 rounded-md py-2 px-4 mx-auto ">
  <a href="<?= URLROOT . '/question/edit/' . $array_data['question']['question_id'] ?>" class="bg-orange-500 hover:bg-orange-700 text-gray-700 font-bold py-2 px-4 rounded">
  Edit Question
</a>
</div>
    </div>
    <div class="flex items-center justify-between mt-4 text-sm text-gray-600 fill-current">
      <div class="flex items-center">
        <span>Was this review helplful?</span>
        <button class="flex items-center ml-6">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 0h1v3l3 7v8a2 2 0 0 1-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 0 1 2-2h7V2a2 2 0 0 1 2-2zm6 10h3v10h-3V10z"/></svg>
          <span class="ml-2"><?= $array_data['question']['upvotes'] ?></span>
        </button>
        <button class="flex items-center ml-4">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 20a2 2 0 0 1-2-2v-6H2a2 2 0 0 1-2-2V8l2.3-6.12A3.11 3.11 0 0 1 5 0h8a2 2 0 0 1 2 2v8l-3 7v3h-1zm6-10V0h3v10h-3z"/></svg>
          <span class="ml-2"><?= $array_data['question']['downvotes'] ?></span>
        </button>
      </div>
    </div>

    <div class="mt-3">
  <h2 class="text-lg font-bold mb-2">Answers</h2>
  <?php foreach ($array_data['answer'] as $answer) { ?>
    <div class="bg-white rounded shadow-md p-4 mb-4">
      <p class="text-gray-600"><?= $answer['body'] ?></p>
      <div class="flex items-center justify-between mt-2">
        <span class="text-gray-600">Answered by <?= $answer['username'] ?></span>
        <div class="flex items-center">
          <button class="flex items-center mr-2">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 0h1v3l3 7v8a2 2 0 0 1-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 0 1 2-2h7V2a2 2 0 0 1 2-2zm6 10h3v10h-3V10z"/></svg>
            <span class="ml-2"><?= $answer['upvotes'] ?></span>
          </button>
          <button class="flex items-center">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 20a2 2 0 0 1-2-2v-6H2a2 2 0 0 1-2-2V8l2.3-6.12A3.11 3.11 0 0 1 5 0h8a2 2 0 0 1 2 2v8l-3 7v3h-1zm6-10V0h3v10h-3z"/></svg>
            <span class="ml-2"><?= $answer['downvotes'] ?></span>
          </button>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>

    </div>

  </div>
</div>
?>

<?php require_once 'app/views/partials/footer.php' ; ?>