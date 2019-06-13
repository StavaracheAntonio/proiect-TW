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
$email = $_POST["email"];

$password = password_hash($password, PASSWORD_DEFAULT);


$query = "SELECT * FROM USERS WHERE username='$username'";
$check = $conn->query($query);

if ($check->num_rows > 0) {
	$response['status'] = 'error';
	$response['message'] = 'username already exists';
	echo json_encode($response);
	exit;
}

$sql = "INSERT INTO USERS (username, password, email) VALUES ('$username', '$password', '$email')";
$result = $conn->query($sql);

if ($result == null) {
	$response['status'] = 'error';
	$response['message'] = 'something went wrong';
	echo json_encode($response);
	exit;
}


$_SESSION["username"] =  $username;
$_SESSION["email"] = $email;

$response['status'] = 'success';
$response['message'] = 'account created';

echo json_encode($response);
