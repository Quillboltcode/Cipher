<?php

class HomeController {
    public function index() {
        // Example logic for the home page
        $pageTitle = "Home Page";
        $welcomeMessage = "Welcome to our MVC application!";

        // Include the home view
        require_once 'views/home.php';
    }
}

?>
