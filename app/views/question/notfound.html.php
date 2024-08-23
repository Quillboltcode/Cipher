<?php
require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';
?>


<h1 class="text-4xl font-bold mb-6 text-center">Sorry, we can't find <span class="font-bold">'<?php echo htmlspecialchars($data['search']); ?>'</span></h1>



<?php require_once 'app/views/partials/footer.php'; ?>