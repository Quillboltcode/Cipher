<?php

require_once('./app/views/partials/head.php');
require_once('./app/views/partials/nav.php');

?>
<?php
$home = json_decode($data,true);
// var_dump($home);
?>

<div class="container mx-auto mt-8 text-center">
        <h1 class="text-4xl font-bold"><?php echo $home['title']; ?></h1>
        <p class="mt-4"><?php echo $home['description']; ?></p>
    </div>


<!-- Site Statistics -->

<div class="container mx-auto mt-8 text-center">
    <h2 class="text-2xl font-bold">Site Statistics</h2>
    <ul class="mt-4 space-y-2 flex justify-center">
        <li class="flex items-center bg-white rounded-lg p-4 shadow-md w-1/3">
            <span class="mr-2">Registered Users:</span>
            <span class="font-semibold"><?php echo $home['user_count']; ?></span>
        </li>
        <li class="flex items-center bg-white rounded-lg p-4 shadow-md w-1/3">
            <span class="mr-2">Questions Asked:</span>
            <span class="font-semibold"><?php echo $home['question_count']['count']; ?></span>
        </li>
        <li class="flex items-center bg-white rounded-lg p-4 shadow-md w-1/3">
            <span class="mr-2">Answers Provided:</span>
            <span class="font-semibold"><?php echo $home['answer_count']['count']; ?></span>
        </li>
    </ul>
</div>
<?php       

require_once('./app/views/partials/footer.php');

?>