<?php require_once 'app/views/partials/head.php'; ?>
<?php require_once 'app/views/partials/nav.php'; ?>

<form action="<?= URLROOT; ?>/contact/send" method="POST" class="max-w-md mx-auto bg-white p-8 mt-8 shadow-md">
  <h2 class="text-lg font-bold mb-4">Get in Touch</h2>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
      Email
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email"
    <?php if (isset($_SESSION['email'])) : ?> 
      value="<?= $_SESSION['email']; ?>"
    <?php else: ?>
      value=""
      <?php endif; ?>
    placeholder="your@email.com">
  </div>
  <div>
    <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">
      Subject
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subject" type="text" name="subject" placeholder="Subject">
  </div>

  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
      Message
    </label>
    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 h-40 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" name="message" placeholder="Your message..."></textarea>
  </div>
  <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
    Send
  </button>
</form>




<?php require_once 'app/views/partials/footer.php'; ?>