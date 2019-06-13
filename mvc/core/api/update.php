<?php
header("Content-type: application/json");
require_once '../utils.php';
require_once '../../app/models/dashboard.php';

$body = file_get_contents("php://input");


$response = array();

if (!isValidJSON($body)) {
    $response = array('error' => 'invalid data');
    echo json_encode($response);
    exit;
}

$data = json_decode($body);

$apiInstance = new DashboardModel();
$result = $apiInstance->updateData($data->username, $data->password);

if ($result == false) {
    $response['status'] = 'error';
    $response['message'] = 'something went wrong';
} else {
    $response['status'] = 'success';
    $response['message'] = 'you changed your password';
}


echo json_encode($response);
