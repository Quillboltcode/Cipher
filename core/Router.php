<?php

namespace Core;
class Router {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        if (file_exists('app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->controller = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
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
