<?php

require_once('./app/views/partials/head.php');
require_once('./app/views/partials/nav.php');

?>


<div class="container mx-auto mt-8 text-center">
        <h1 class="text-4xl font-bold"><?php echo $data['title']; ?></h1>
        <p class="mt-4"><?php echo $data['description']; ?></p>
    </div>

<?php       

require_once('./app/views/partials/footer.php');

?>