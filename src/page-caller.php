<?php

    include_once('classes/ErrorPage.php');
    include_once('classes/Config.php');
    include_once('classes/Api.php');
    include_once('classes/Template.php');

    session_start();
    register_shutdown_function("braincart\ErrorPage::shutdown");
    
    new braincart\Config;

    $uri = $_SERVER['REQUEST_URI'];
    if (strstr($uri, '?')){
        $uri = substr($uri, 0, strpos($uri, '?'));
    }

    $bc = new braincart\Api();
    $bc->get('page/'.$uri);

    if (!empty($bc->getResponse())){
        if ($bc->getStatus() == 'success'){
            if (!empty($bc->getPayload()->page->template)){
                new braincart\Template($bc->getPayload()->page->template,$bc->getPayload());
            }
        } else {
            if ($bc->getStatusCode() == 404){
                braincart\ErrorPage::notFound();
            } else {
                braincart\ErrorPage::api($bc->getError());
            }
        }
    } else {
        braincart\ErrorPage::connection();
    }