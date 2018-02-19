<?php

include_once '../entity/Income.php';
include_once '../dao/IncomeDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_GET, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $incomeDao = new IncomeDaoImpl();
    $result = $incomeDao->getAllIncomes();
    $incomes = array();
    /* @var $ic Category */
    foreach ($result as $income) {
        array_push($incomes, $income);
    }
    echo json_encode($ics);
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}