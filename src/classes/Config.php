<?php 

namespace braincart;

class Config {

    function __construct(){
        
        $file = '../../../../config.inc.php';
        if (file_exists($file)){
            require($file);
        } else {
            $error = 'Could not log config file';
            error_log($error.': '.$file);
            die($error);
        }
    }
}