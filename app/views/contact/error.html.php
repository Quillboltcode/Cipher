<?php require_once 'app/views/partials/head.php'; ?>
<?php require_once 'app/views/partials/nav.php'; ?>


<?php if (isset($errors['error'])) : ?>
<h1 class="text-4xl font-bold mb-6 text-center text-red-400"><?php echo $errors['error']; ?></h1>
<?php elseif (isset($data['success'])) : ?>
<h1 class="text-4xl font-bold mb-6 text-center text-green-400"><?php echo $errors['success']; ?></h1>
<?php endif; ?>


<?php require_once 'app/views/partials/footer.php'; ?>