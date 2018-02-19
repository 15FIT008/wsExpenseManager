<?php

include_once '../entity/Outcome.php';
include_once '../dao/OutcomeDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_output(INPUT_GET, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $outcomeDao = new OutcomeDaoImpl();
    $result = $outcomeDao->getAllOutcomes();
    $outcomes = array();
    /* @var $ic Category */
    foreach ($result as $outcome) {
        array_push($outcomes, $outcome);
    }
    echo json_encode($ics);
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}