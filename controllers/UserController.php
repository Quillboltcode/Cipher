<?php
require_once 'autoload.php';
require_once 'models/User.php';
// use Models\User;
class UserController {
    public function profile() {
        // Fetch user data (you can replace this with real data fetching logic)
        $user = new User();
        $user->Username = 'John Doe';
        $user->Email = 'john.doe@example.com';
        $user->DateJoined = '2023-01-01';
        $user->Reputation = 1200;
        $user->ProfilePicture = 'path/to/profile_picture.jpg';

        // Include the profile view
        require_once 'views/user/profile.html.php';
    }
}
?>
