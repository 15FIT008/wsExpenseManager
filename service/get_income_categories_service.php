<?php

include_once '../entity/IncomeCategory.php';
include_once '../dao/IncomeCategoryDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_GET, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $icDao = new IncomeCategoryDaoImpl();
    $result = $icDao->getAllIncomeCategory();
    $ics = array();
    /* @var $ic Category */
    foreach ($result as $ic) {
        array_push($ics, $ic);
    }
    echo json_encode($ics);
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}