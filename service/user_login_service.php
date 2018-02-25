<?php

include_once '../entity/User.php';
include_once '../dao/UserDaoImpl.php';
include_once '../util/PDOUtil.php';

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
if (isset($email) && isset($password) && !empty($email) &&!empty($password)) {
    $userDao = new UserDaoImpl();
    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);
    $userDao->setData($user);
    $result = $userDao->login();
    if (isset($result) && $result->email) {
        $data = array('status' => 1, 'message' => 'Login success', 'user' => $result);
    } else {
        $data = array('status' => 0, 'message' => 'Invalid username or password');
    }
} else {
    $data = array('status' => 0, 'message' => 'Please provide username and password');
}
header ('Content-type:application/json');
echo json_encode($data);
