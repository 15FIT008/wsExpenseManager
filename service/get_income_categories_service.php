<?php

include_once '../entity/IncomeCategory.php';
include_once '../dao/IncomeCategoryDaoImpl.php';
include_once '../util/PDOUtil.php';

$icDao = new IncomeCategoryDaoImpl();
/* @var $result PDOStatement */
$result = $icDao->getAllIncomeCategory();
$data = $result->fetchAll();

header('Content-type:application/json');
echo json_encode($data);
