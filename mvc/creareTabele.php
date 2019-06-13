<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "trips";


function createCities($conn)
{

	$sql = "CREATE OR REPLACE TABLE CITIES (
			CITY_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			NAME VARCHAR(30) NOT NULL,
			DESCRIPTION VARCHAR(1024) NOT NULL,
			IMAGE VARCHAR(1024)
			)";

	if ($conn->query($sql) === TRUE) {
		echo "Table CITIES created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function createCategories($conn)
{

	$sql = "CREATE OR REPLACE TABLE CATEGORIES (
			CATEGORY_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			NAME VARCHAR(30) NOT NULL
			)";

	if ($conn->query($sql) === TRUE) {
		echo "Table CATEGORIES created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function createUsers($conn)
{

	$sql = "CREATE OR REPLACE TABLE USERS (
			USER_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			FIRST_NAME VARCHAR(30) NOT NULL,
			LAST_NAME VARCHAR(30) NOT NULL,
			USERNAME VARCHAR(30) NOT NULL,
			EMAIL VARCHAR(30) NOT NULL,
			PASSWORD VARCHAR(1024) NOT NULL
			)";

	if ($conn->query($sql) === TRUE) {
		echo "Table USERS created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function createFlights($conn)
{

	$sql = "CREATE OR REPLACE TABLE FLIGHTS (
			FLIGHT_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			DEPARTURE_CITY_ID INT(6) UNSIGNED, 
			ARRIVE_CITY_ID INT(6) UNSIGNED,
			DEPARTURE_DATE DATE,
			ARRIVAL_DATE DATE,
			PRICE INT(6),
			FOREIGN KEY (DEPARTURE_CITY_ID) REFERENCES CITIES(CITY_ID),
			FOREIGN KEY (ARRIVE_CITY_ID) REFERENCES CITIES(CITY_ID)
			)";

	if ($conn->query($sql) === TRUE) {
		echo "Table FLIGHTS created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function createSavedFlights($conn)
{
	$sql = "CREATE OR REPLACE TABLE SAVED_FLIGHTS (
		USERNAME VARCHAR(30) ,
		DEPARTURE_CITY VARCHAR(30) , 
		ARRIVE_CITY VARCHAR(30),
		DEPARTURE_DATE VARCHAR(30),
		ARRIVAL_DATE VARCHAR(30),
		PRICE INT(6)
		)";

	if ($conn->query($sql) === TRUE) {
		echo "Table SAVED_FLIGHTS created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function createPictureTripCard($conn)
{

	$sql = "CREATE OR REPLACE TABLE PICTURE_TRIP_CARD (
			ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			CITY_ID INT(6) UNSIGNED,
			PATH VARCHAR(256),
			FOREIGN KEY (CITY_ID) REFERENCES CITIES(CITY_ID)
			)";

	if ($conn->query($sql) === TRUE) {
		echo "Table PICTURE_TRIP_CARD created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function createPictureTrip($conn)
{

	$sql = "CREATE OR REPLACE TABLE PICTURE_TRIP (
			ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			CITY_ID INT(6) UNSIGNED,
			PATH VARCHAR(256),
			FOREIGN KEY (CITY_ID) REFERENCES CITIES(CITY_ID)
			)";

	if ($conn->query($sql) === TRUE) {
		echo "Table PICTURE_TRIP created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function createTypesofCity($conn)
{

	$sql = "CREATE OR REPLACE TABLE TYPES_OF_CITY (
			ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			CITY_ID INT(6) UNSIGNED,
			CATEGORY_ID INT(6) UNSIGNED,
			FOREIGN KEY (CITY_ID) REFERENCES CITIES(CITY_ID),
			FOREIGN KEY (CATEGORY_ID) REFERENCES CATEGORIES(CATEGORY_ID)
			)";

	if ($conn->query($sql) === TRUE) {
		echo "Table TYPES_OF_CITY created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	echo "<br>";
}

function setForeignKeyChecks($conn)
{

	$sql = "SET FOREIGN_KEY_CHECKS = 0;";

	if ($conn->query($sql) === TRUE) {
		echo "FOREIGN KEY constraints unchecked!";
	} else {
		echo "Error at unsetting the foreign key constraintrs " . $conn->error;
	}
	echo "<br>";
}





$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully <br>";

setForeignKeyChecks($conn);
createCities($conn);
createCategories($conn);
createUsers($conn);
createFlights($conn);
createSavedFlights($conn);
createPictureTripCard($conn);
createPictureTrip($conn);
createTypesofCity($conn);
