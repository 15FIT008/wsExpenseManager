<?php

include_once '../entity/User.php';
include_once '../entity/IncomeCategory.php';
include_once '../entity/Income.php';
include_once '../dao/IncomeDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_POST, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $amount = filter_input(INPUT_POST, 'amount');
    $description= filter_input(INPUT_POST, 'description');
    $date = filter_input(INPUT_POST, 'date');
    $category = filter_input(INPUT_POST, 'category');
    $user = filter_input(INPUT_POST, 'user');
    if (isset($amount) && !empty($amount)) {
        $incomeDao = new IncomeDaoImpl();
        $income = new Income();
        $income->setAmount($amount);
        $income->setDescription($description);
        $income->setDate($date);
        $income->setCategory($category);
        $income->setUser($user);
        $incomeDao->addNewIncome($income);
        $jsonData = array();
        $jsonData['status'] = 1;
        $jsonData['message'] = 'Data successfully added';
        echo json_encode($jsonData);
    } else {
        $jsonData = array();
        $jsonData['status'] = 2;
        $jsonData['message'] = 'Name is null';
        echo json_encode($jsonData);
    }
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}