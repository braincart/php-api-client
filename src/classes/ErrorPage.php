<?php

namespace braincart;

class ErrorPage {

    static function shutdown() {

        $error = error_get_last();
        if (!is_null($error) && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) {
            new Template('error_500');
        }
    }

    static function connection() {

        error_log('Client could not call API or get any response.');
        http_response_code(500);
        new Template('error_500');
    }

    static function api($message) {

        error_log('API returned error: '.$message);
        http_response_code(500);
        new Template('error_500');
    }

    static function notFound() {

        http_response_code(404);
        new Template('error_404');
    }

    static function template($path) {

        error_log('Could not locate template file : '.$path.'.');
        http_response_code(500);
        new Template('error_500');
    }
}