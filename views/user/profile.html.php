<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./public/css/output.css">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex items-center justify-between p-6">
            <div class="flex items-center">
                <img class="w-16 h-16 rounded-full" src="<?php echo $user->ProfilePicture; ?>" alt="User Profile Picture">
                <div class="ml-4">
                    <h1 class="text-xl font-semibold text-gray-800"><?php echo $user->Username; ?></h1>
                    <p class="text-gray-600"><?php echo $user->Email; ?></p>
                </div>
            </div>
            <div>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Edit Profile</button>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <dl class="divide-y divide-gray-200">
                <div class="px-6 py-4">
                    <dt class="text-sm font-medium text-gray-500">Date Joined</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo $user->DateJoined; ?></dd>
                </div>
                <div class="px-6 py-4">
                    <dt class="text-sm font-medium text-gray-500">Reputation</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo $user->Reputation; ?></dd>
                </div>
            </dl>
        </div>
    </div>
</div>

</body>
</html>
