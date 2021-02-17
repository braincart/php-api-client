<?php

namespace braincart;

class Api {

    private $requestMethod;
    private $requestUri;
    private $requestBase;
    private $requestBody = [];
    private $requestResponse;

    function __construct(){
        
        $this->requestBase = [
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'session_id' => @$_SESSION['session_id'] ?: NULL,
            'session_key' => @$_SESSION['session_key'] ?: NULL,
        ];
    }

    function call(){

        $this->requestBody = json_encode(array_merge($this->requestBase,$this->requestBody));

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $this->requestBody,
            CURLOPT_CUSTOMREQUEST  => $this->requestMethod,
            CURLOPT_URL            => CONFIG['API_URL'].'/'.$this->requestUri,
            CURLOPT_USERPWD        => CONFIG['API_USER']. ":" .CONFIG['API_KEY'],
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($this->requestBody),
            ],
        ]);

        $response = json_decode(curl_exec($curl));
        if (!empty($response->session->id) && !empty($response->session->key)){
            $_SESSION['session_id']    = $response->session->id;
            $_SESSION['session_key']   = $response->session->key;
            $_SESSION['language_code'] = $response->session->language_code;
            $_SESSION['currency_code'] = $response->session->currency_code;
        }

        $this->requestResponse = $response;
    }

    // Method shortcuts

    function get($uri,$body = false){
        $this->requestMethod = 'GET';
        $this->requestUri = $uri;
        if ($body){
            $this->requestBody = $body;
        }
        $this->call();
    }
    
    function post($uri,$body = false){
        $this->requestMethod = 'POST';
        $this->requestUri = $uri;
        if ($body){
            $this->requestBody = $body;
        }
        $this->call();
    }

    function put($uri,$body = false){
        $this->requestMethod = 'PUT';
        $this->requestUri = $uri;
        if ($body){
            $this->requestBody = $body;
        }
        $this->call();
    }

    function delete($uri,$body = false){
        $this->requestMethod = 'DELETE';
        $this->requestUri = $uri;
        if ($body){
            $this->requestBody = $body;
        }
        $this->call();
    }

    // Getters

    function getResponse(){
        return $this->requestResponse;
    }

    function getStatus(){
        return $this->requestResponse->status;
    }

    function getStatusCode(){
        return $this->requestResponse->status_code;
    }

    function getError(){
        return $this->requestResponse->error;
    }

    function getSession(){
        return $this->requestResponse->session;
    }

    function getPayload(){
        return $this->requestResponse->payload;
    }

}