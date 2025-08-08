<?php

namespace braincart;

class Token {

    private $token = false;
    private $path = '../../../../token.json';

    function __construct() {
        if (!is_file($this->path)) {
            return;
        }
        $token = @file_get_contents($this->path);
        if (is_string($token) && $token !== '') {
            $this->token = $token;
        }
    }

    function updateToken($newToken) {
        if (!$newToken || $this->token === $newToken) {
            return;
        }
        $fp = @fopen($this->path, 'c+');
        if ($fp) {
            if (flock($fp, LOCK_EX)) {
                ftruncate($fp, 0);
                rewind($fp);
                fwrite($fp, $newToken);
                fflush($fp);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }
    }

    function getToken() {
        return $this->token;
    }
}