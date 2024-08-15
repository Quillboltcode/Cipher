<?php

function dd($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();

}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

/**
 * Simple helper to debug to the console
 *
 * @param $data object, array, string $data
 * @param $context string  Optional a description.
 *
 * @return string
 */
function debug_to_console($data, $context = 'Debug in Console') {

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    

    $output  = 'console.info(\'' . $context . ':\');';
    $output .= 'console.log(' . json_encode($data) . ');';
    $output  = sprintf('<script>%s</script>', $output);

    echo $output;
    return $output;
}


    /**
     * Helper function to calculate the time difference between a given time and the current time
     * and display it as "X hours ago".
     *
     * @param string $time The given time in a valid date/time format.
     * @param string $format The format of the given time. Default is 'Y-m-d H:i:s'.
     * @return string The time difference in the format "X hours ago".
     */
    function timeDiffForDisplay(string $time, string $format = 'Y-m-d H:i:s'): string {
        $datetime1 = new DateTime($time);
        $datetime2 = new DateTime();
        $interval = $datetime1->diff($datetime2);

        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');

        if (48 <= $hours && $hours > 0) {
            return "$hours hours ago";
        } elseif ($minutes > 3) {
            return "$minutes minutes ago";
        } elseif ($minutes < 3) {
            return "Just now";
        }  else {
            return $datetime1->format($format); 
        }
    }



