<?php

namespace braincart;

class Template {

    function __construct($path,$data = NULL){

        $path = CONFIG['ROOT_DIR'].'/'.CONFIG['TEMPLATES_DIR'].'/'.$path.'.'.CONFIG['TEMPLATE_FILETYPE'];
        if (file_exists($path)){
            ob_start();
            require_once($path);
            echo ob_get_clean();
        } else {
            ErrorPage::template($path);
        }
    }
}