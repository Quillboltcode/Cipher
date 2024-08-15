<?php

namespace Core;
use DateTime;
class Controller {

    public function view($view, $data = []) {
        require_once 'app/views/' . $view . '.html.php';
    }

    public function render($file, $data = []) {
        $viewFile = 'app/views/' . $file . '.html.php';
        if (!file_exists($viewFile)) {
            $viewFile = './app/views/404.php';
        }
        extract($data);
        ob_start();
        require_once $viewFile;
        $content = ob_get_clean();
    }

        /**
     * Helper function to calculate the time difference between a given time and the current time
     * and display it as "X hours ago".
     *
     * @param string $time The given time in a valid date/time format.
     * @param string $format The format of the given time. Default is 'Y-m-d H:i:s'.
     * @return string The time difference in the format "X hours ago".
     */
     public function timeDiffForDisplay(string $time, string $format = 'Y-m-d H:i:s'): string {
        $datetime1 = new DateTime($time);
        $datetime2 = new DateTime();
        $interval = $datetime1->diff($datetime2);

        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');

        if (72 <= $hours && $hours > 0) {
            return "$hours hours ago";
        } elseif ($minutes > 3) {
            return "$minutes minutes ago";
        } elseif ($minutes < 3) {
            return "Just now";
        }   
        else {
            return $datetime1->format($format); 
        }
    }
}
