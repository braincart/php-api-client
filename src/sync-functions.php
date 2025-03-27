<?php

    function apiGetProducts($brandIds = null, $categoryId = null, $priceMin = null, $priceMax = null, $filters = null, $order = null, $limit = null, $successCallback = null, $errorCallback = null){

        $bc = new braincart\Api();
        $bc->get('/products',[
            'brand' => $brandIds,
            'category' => $categoryId,
            'price_min' => $priceMin,
            'price_max' => $priceMax,
            'filters'  => $filters,
            'order' => $order,
            'limit' => $limit
        ]);

        return $bc->getResponse();
    }

    function apiPostAffiliate($affiliateCode, $successCallback = null, $errorCallback = null){

        $bc = new braincart\Api();
        $bc->post('/affiliate',[
            'affiliate_code' => $affiliateCode,
        ]);

        return $bc->getResponse();
    }

    function apiPostListConfirm($list, $email, $key, $successCallback = null, $errorCallback = null){

        $bc = new braincart\Api();
        $bc->post('/list/confirm',[
            'list' => $list,
            'email' => $email,
            'key' => $key
        ]);

        return $bc->getResponse();
    }

    function apiPostListUnsubscribe($list, $email, $key, $successCallback = null, $errorCallback = null){

        $bc = new braincart\Api();
        $bc->post('/list/unsubscribe',[
            'list' => $list,
            'email' => $email,
            'key' => $key
        ]);

        return $bc->getResponse();
    }

    function apiPutSessionLanguage($languageCode, $pageUrl, $successCallback = null, $errorCallback = null){

        $bc = new braincart\Api();
        $bc->put('/session/language/'.$languageCode,[
            'url' => $pageUrl
        ]);

        return $bc->getResponse();
    }