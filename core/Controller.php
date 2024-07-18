<?php

namespace Core;
class Controller {
    public function model($model) {
        require_once 'app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []) {
        require_once 'app/views/' . $view . '.html.php';
    }

    public function render($file, $data = []) {
        $viewFile = 'app/views/' . $file . '.html.php';
        if (!file_exists($viewFile)) {
            $viewFile = 'app/views/404.php';
        }
        extract($data);
        ob_start();
        require_once $viewFile;
        $content = ob_get_clean();
        // require_once 'app/views/partials/header.php';
        // require_once 'app/views/partials/nav.php';
        // require_once 'app/views/partials/footer.php';
    }
}
