<?php
header("Content-type: application/json");
require_once '../utils.php';
require_once '../../app/models/dashboard.php';

$body = file_get_contents("php://input");


if (!isValidJSON($body)) {
    $response = array('error' => 'invalid data');
    echo json_encode($response);
    exit;
}

$data = json_decode($body);

$apiInstance = new DashboardModel();
$flights = $apiInstance->getFlights($data->username);

echo json_encode($flights);
