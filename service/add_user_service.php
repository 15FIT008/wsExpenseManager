<?php

include_once '../entity/User.php';
include_once '../dao/UserDaoImpl.php';
include_once '../util/PDOUtil.php';
include_once '../util/Utility.php';

$fullname = filter_input(INPUT_POST, 'fullname');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
if (isset($fullname) && isset($email) && isset($password) && !empty($email) && !empty($fullname) && !empty($password)) {
    $userDao = new UserDaoImpl();
    $user = new User();
    $user->setFullname($fullname);
    $user->setEmail($email);
    $user->setPassword($password);
    $userDao->setData($user);
    $userDao->addNewUser();
    $jsonData = array();
    $jsonData['status'] = 1;
    $jsonData['message'] = 'Data successfully added';
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'Name is null';
}
header("content-type:application/json");
echo json_encode($jsonData);
