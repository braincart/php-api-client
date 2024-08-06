<?php

namespace braincart;

class ErrorAsync {

    static function shutdown() {

        $error = error_get_last();
        if (!is_null($error) && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) {
            error_log($error['message']);
        }
    }

    static function connection() {

        error_log('Client could not call API or get any response.');
        http_response_code(500);
    }

    static function api($message) {

        error_log('API returned error: '.$message);
        http_response_code(500);
    }
}