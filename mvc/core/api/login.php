<?php
header("Content-type: application/json");
session_start();

require_once '../utils.php';
require_once '../db.php';

$response = array();

$dataBase = Database::getInstance();
$conn = $dataBase->getConnection();


$username = mysqli_real_escape_string($conn, $_POST["username"]); /// protejeaza de sql injection
$password = mysqli_real_escape_string($conn, $_POST["password"]);




$sql = "SELECT username, email, password FROM USERS WHERE username='$username'";
$result = $conn->query($sql);

if ($result == null) {
    $response['status'] = 'error';
    $response['message'] = 'something went wrong';
    echo json_encode($response);
    exit;
}

if ($result->num_rows == 0) {
    $response['status'] = 'error';
    $response['message'] = 'invalid username or password';
    echo json_encode($response);
    exit;
}


$row = $result->fetch_assoc();



if (password_verify($password, $row["password"]) == 1) {
    $_SESSION["username"] =  $row["username"];
    $_SESSION["email"] = $row["email"];

    $response['status'] = 'success';
    $response['message'] = 'you are logged in';
} else {
    $response['status'] = 'error';
    $response['message'] = 'invalid username or password';
}


echo json_encode($response);
