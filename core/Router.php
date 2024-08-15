<?php

namespace Core;
class Router {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    /**
     * Constructs a new instance of the class and initializes the controller and method based on the URL.
     *
     * This constructor first calls the `parseUrl()` method to get the URL segments. If the URL is empty, it sets the
     * controller to 'HomeController'. Otherwise, it checks if the first segment exists as a controller file and sets the
     * controller accordingly. The controller file is then required.
     *
     * After that, the constructor checks if the second segment exists as a method in the controller class. If it does, it
     * sets the method and removes the second segment from the URL. If the method does not exist, it checks if the
     * controller class has an 'index' method and sets the method accordingly.
     *
     * Finally, the constructor sets the remaining URL segments as parameters and calls the controller method with the
     * parameters.
     *
     * @throws \Exception If the controller file does not exist or if the controller class does not have the specified
     *                    method.
     * Example usage: url => http://localhost:8080/Cipher/questions/index
     * $controller = new QuestionController();
     * $controller->index();
     */
    public function __construct() {
        $url = $this->parseUrl();

        if (empty($url)) {
            $this->controller = 'HomeController';
        } else {
            if (file_exists('app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
                $this->controller = ucwords($url[0]) . 'Controller';
                unset($url[0]);
            }
        }

        if (empty($this->controller)) {
            throw new \Exception('The controller file does not exist.');
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        // Instantiate the controller class
        if (!class_exists($this->controller)) {
            throw new \Exception('The controller class does not exist.');
        }

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                throw new \Exception('The controller class does not have the specified method.');
            }
        } else if (method_exists($this->controller, 'index')) {
            $this->method = 'index';
        } else {
            throw new \Exception('The controller class does not have an index method.');
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parses the URL and returns an array of segments.
     *
     * @return array|null The array of URL segments or null if the 'url' parameter is not set.
     */
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function createUrl($controller,$action='',$params=[]) : string {
        $url = URLROOT . '/' . $controller . '/' . $action;
        if ($action) {
            $url .= '/' . $action;
        }
        
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $url .= '/' . $key . '/' . $value;
            }
        }
        return $url;
    }
}
