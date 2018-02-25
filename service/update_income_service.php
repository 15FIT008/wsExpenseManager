<?php

include_once '../entity/User.php';
include_once '../entity/IncomeCategory.php';
include_once '../entity/Income.php';
include_once '../dao/IncomeDaoImpl.php';
include_once '../util/PDOUtil.php';
include_once '../util/Utility.php';

$amount = filter_input(INPUT_POST, 'amount');
$description = filter_input(INPUT_POST, 'description');
$date = filter_input(INPUT_POST, 'date');
$user = filter_input(INPUT_POST, 'user');
$category = filter_input(INPUT_POST, 'category');
$id = filter_input(INPUT_POST, 'id');
if (isset($amount) && isset($description) && isset($date) && isset($category) && isset($user) && isset($id) && !empty($id) && !empty($amount) && !empty($category) && !empty($date)&& !empty($description) && !empty($user)) {
    $incomeDao = new IncomeDaoImpl();
    $income = new Income();
    $ic = new IncomeCategory();
    $u = new User();
    $ic->setId($category);
    $u->setId($user);
    $income->setId($id);
    $income->setAmount($amount);
    $income->setDescription($description);
    $income->setDate($date);
    $income->setCategory($ic);
    $income->setUser($u);
    $incomeDao->setData($income);
    $incomeDao->updateIncome();
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
header("content-type:application/json");
echo json_encode($jsonData);
