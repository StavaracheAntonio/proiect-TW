<?php
header("Content-type: application/json");
require_once 'api.php';

function isValidJSON($body)
{ // verifica daca datele JSON sunt corecte
    json_decode($body);
    return json_last_error() == JSON_ERROR_NONE;
}

$body = file_get_contents("php://input");


if (!isValidJSON($body)) {
    $response = array('error' => 'invalid data');
    echo json_encode($response);
    exit;
}

$data = json_decode($body);

if (!isset($data->from) || !isset($data->budget) || !isset($data->duration) || !isset($data->hashTag)) {
    $response = array('error' => 'invalid data');
    echo json_encode($response);
    exit;
}


$from = $data->from;
$budget = $data->budget;
$duration = $data->duration;
$hashTag = $data->hashTag;

$apiInstance = new MyApi();
$citiesByCat = $apiInstance->getByCategory($hashTag);

echo json_encode($citiesByCat);
