<?php
header("Content-type: application/json");
require_once '../utils.php';
require_once '../api.php';

$body = file_get_contents("php://input");


if (!isValidJSON($body)) {
    $response = array('error' => 'invalid data');
    echo json_encode($response);
    exit;
}

$data = json_decode($body);


if (!isset($data->city)) {
    $response = array('error' => 'invalid data');
    echo json_encode($response);
    exit;
}


$cityName = $data->city;

$apiInstance = new InfoApi();
$cityInfo = $apiInstance->getDestInfo($cityName);

echo json_encode($cityInfo);
