<?php
require_once 'autoload.php';
require_once 'routes.php';

// Get the current URL path
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$path = str_replace(dirname($scriptName), '', $requestUri);
// $path = trim($path, '/');

// Find the corresponding controller and action
if (array_key_exists($path, $routes)) {
    list($controllerName, $action) = explode('@', $routes[$path]);
    $controllerFile = 'controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerName();

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo "Action $action not found in controller $controllerName.";
        }
    } else {
        echo "Controller file $controllerFile not found.";
    }
} else {
    echo "Route not found.";
}
?>

