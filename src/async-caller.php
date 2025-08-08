<?php

    include_once('classes/ErrorAsync.php');
    include_once('classes/Config.php');
    include_once('classes/Api.php');
    include_once('classes/Template.php');
    include_once('classes/Token.php');

    session_start();
    register_shutdown_function("braincart\ErrorAsync::shutdown");
    
    new braincart\Config;

    $bc = new braincart\Api();

    $body = false;
    if (!empty($_POST['body'])){
        $body = $_POST['body'];
    }
    if (strToUpper($_POST['method']) == 'GET'){
        $bc->get($_POST['endpoint'],$body);
    } elseif (strToUpper($_POST['method']) == 'POST'){
        $bc->post($_POST['endpoint'],$body);
    } elseif (strToUpper($_POST['method']) == 'PUT'){
        $bc->put($_POST['endpoint'],$body);
    } elseif (strToUpper($_POST['method']) == 'DELETE'){
        $bc->delete($_POST['endpoint'],$body);
    }

    if (!empty($bc->getResponse())){
        $response = $bc->getResponse();
        http_response_code($response->status_code);
        echo json_encode($response);
    } else {
        braincart\ErrorAsync::connection();
    }