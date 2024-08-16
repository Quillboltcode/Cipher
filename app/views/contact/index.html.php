<?php require_once 'app/views/partials/head.php'; ?>
<?php require_once 'app/views/partials/nav.php'; ?>
<?php 
var_dump(getenv('POSH_PID'));
var_dump($_ENV['POSH_PID']);
?>
<form class="max-w-md mx-auto bg-white p-8 mt-8 shadow-md">
  <h2 class="text-lg font-bold mb-4">Get in Touch</h2>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
      Email
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="your@email.com">
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
      Message
    </label>
    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" placeholder="Your message..."></textarea>
  </div>
  <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
    Send
  </button>
</form>




<?php require_once 'app/views/partials/footer.php'; ?>