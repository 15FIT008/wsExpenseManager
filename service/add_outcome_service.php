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
    $amount = filter_input(INPUT_POST, 'amount');
    $description= filter_input(INPUT_POST, 'description');
    $date = filter_input(INPUT_POST, 'date');
    $category = filter_input(INPUT_POST, 'category');
    $user = filter_input(INPUT_POST, 'user');
    $datas = array ($amount,$description,$date,$category,$user);
    if (arrayIsEmpty($datas)) {
        $outcomeDao = new IncomeDaoImpl();
        $outcome = new Income();
        $outcome->setAmount($amount);
        $outcome->setDescription($description);
        $outcome->setDate($date);
        $outcome->setCategory($category);
        $outcome->setUser($user);
        $outcomeDao->addNewIncome($outcome);
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