<?php 
require_once './app/views/partials/head.php';
require_once './app/views/partials/nav.php';
?>
<?php 
// var_dump($data);?>

<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-4">Create Answer</h1>
    <form action="<?php htmlspecialchars( URLROOT.'/answer/edit/'.$data['answer_id']);?>" method="post">
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Content:</label>
            <textarea id="content" name="content" class="w-full border border-gray-400 p-2 rounded-lg" 
            <?php if(isset($data['body'])) echo 'value="'.$data['body'].'"';
            ?>
            required></textarea>
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </div>
    </form>
</div>



<?php require_once './app/views/partials/footer.php'; ?>