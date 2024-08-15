<?php
require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';
?>

<h1 class="text-4xl font-bold mb-6 text-center"><?php echo $data['title']; ?></h1>
<?php
var_dump($_SESSION);
$array_data = json_decode(json_encode($data), true);
// var_dump($array_data['questions']);
foreach ($array_data['questions'] as $question) {
        echo '<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 text-center mr-6">
                        <div class="text-xl font-semibold">' . $question['upvotes']-$question['downvotes'] . '</div>
                        <div class="text-gray-500">vote</div>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-xl font-bold text-blue-600 mb-2">'
                            . '<a href="' . URLROOT . '/question/show/' . $question['question_id'] . '"
                            class="hover:underline">' . $question['title'] . '</a>
                        </h2>
                        <p class="text-gray-700 mb-4 line-clamp-2 hover:line-clamp-3">
                            ' . $question['body'] . '
                        </p>
                        <div class="flex items-center mb-4">';
                            $tag = explode(',', $question['module_names']);
                            foreach ($tag as $value) {
                                echo '<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">' . $value . '</span>';
                            }
                            echo '
                        
                        </div>
                        <div class="flex items-center text-gray-500 text-sm">
                            <img src="https://via.placeholder.com/24" alt="User avatar" class="w-6 h-6 rounded-full mr-2">
                            <span class="font-semibold mr-1">' . $question['username'] . '</span>
                            <span>11</span>
                            <span class="ml-2">';
                                if ($question['created_at'] == $question['updated_at']) {
                                    echo $question['created_at'];
                                } else {
                                    echo $question['updated_at'];
                                }
                        echo '</span>
                        </div>
                    </div>
                </div>
            </div>';
    }
 ?>




    <?php require_once 'app/views/partials/footer.php'; ?>