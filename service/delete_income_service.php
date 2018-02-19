<?php

include_once '../entity/User.php';
include_once '../entity/IncomeCategory.php';
include_once '../entity/Income.php';
include_once '../dao/IncomeDaoImpl.php';
include_once '../util/PDOUtil.php';
include_once '../util/Utility.php';

$apiKey = filter_input(INPUT_POST, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $id = filter_input(INPUT_POST, 'id');
    $datas = array ($id);
    if (arrayIsEmpty($datas)) {
        $incomeDao = new IncomeDaoImpl();
        $income = new Income();
        $income->setId($id);
        $incomeDao->deleteIncome($income);
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