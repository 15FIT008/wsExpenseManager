<?php

include_once '../entity/OutcomeCategory.php';
include_once '../dao/OutcomeCategoryDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_GET, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $ocDao = new OutcomeCategoryDaoImpl();
    $result = $ocDao->getAllOutcomeCategory();
    $ocs = array();
    /* @var $ic Category */
    foreach ($result as $oc) {
        array_push($ocs, $oc);
    }
    echo json_encode($ocs);
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}