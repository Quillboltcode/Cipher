<?php
ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
session_start();
use Core\Router;
use Controllers\{AnswerController, CommentController, QuestionController, UserController};
require_once 'config.php';
require_once 'core/Router.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Model.php';
require_once 'core/Authenticator.php';
require_once 'app/routes.php';
// require_once 'autoload.php';
$router = new Router();

// $Router = new Router();
?>
