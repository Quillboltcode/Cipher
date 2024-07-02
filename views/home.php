<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="./public/css/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6"><?php echo $pageTitle; ?></h1>
            <p class="text-gray-700"><?php echo $welcomeMessage; ?></p>
        </div>
    </div>
</div>

</body>
</html>
