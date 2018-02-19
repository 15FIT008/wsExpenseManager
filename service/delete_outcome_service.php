<?php

include_once '../entity/User.php';
include_once '../entity/OutcomeCategory.php';
include_once '../entity/Outcome.php';
include_once '../dao/OutcomeDaoImpl.php';
include_once '../util/PDOUtil.php';
include_once '../util/Utility.php';

$apiKey = filter_input(INPUT_POST, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $id = filter_input(INPUT_POST, 'id');
    $datas = array ($id);
    if (arrayIsEmpty($datas)) {
        $outcomeDao = new OutcomeDaoImpl();
        $outcome = new Outcome();
        $outcome->setId($id);
        $outcomeDao->deleteOutcome($outcome);
        $jsonData = array();
        $jsonData['status'] = 1;
        $jsonData['message'] = 'Data successfully added';
        echo json_encode($jsonData);
    } else {
        $jsonData = array();
        $jsonData['status'] = 2;
        $jsonData['message'] = 'Your data is not completed';
        echo json_encode($jsonData);
    }
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}