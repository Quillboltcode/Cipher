<?php
require('partials/head.php');
require('partials/nav.php');?>
<?php
$content = ob_get_clean(); 
require('layout.html.php'); 
?>
<?php require('partials/footer.php');?>

