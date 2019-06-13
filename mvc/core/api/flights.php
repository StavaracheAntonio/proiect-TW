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


$apiInstance = new MyApi();
$flights = $apiInstance->flightsBetweenTwoCities($data->from, $data->to, $data->departDate, $data->arriveDate, $data->budgetMin, $data->budgetMax, $data->duration);

echo json_encode($flights);
