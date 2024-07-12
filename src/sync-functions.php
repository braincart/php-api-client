<?php

    function apiGetProducts($bandIds = null, $categoryId = null, $priceMin = null, $priceMax = null, $filters = null, $order = null, $limit = null, $successCallback = null, $errorCallback = null){

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