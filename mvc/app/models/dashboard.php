<?php

class DashboardModel
{

    public function insertFlight(
        $user,
        $departure_city,
        $arrival_city,
        $departure_date,
        $arrival_date,
        $price
    ) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "trips";

        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO SAVED_FLIGHTS (username,departure_city,arrive_city,departure_date,arrival_date,price)
			VALUES ('$user','$departure_city','$arrival_city','$departure_date','$arrival_date','$price')
		";

        $conn->query($sql);

        $conn->close();
    }

    public function getFlights($user)
    {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "trips";

        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM SAVED_FLIGHTS WHERE username = '$user'
		";


        $result = $conn->query($sql);


        if (!isset($result->num_rows)) {
            return null;
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flights[] = array(
                    'departureCity' => $row['DEPARTURE_CITY'],
                    'arriveCity' => $row['ARRIVE_CITY'],
                    'departureDate' => $row['DEPARTURE_DATE'],
                    'arrivalDate' => $row['ARRIVAL_DATE'],
                    'price' => $row['PRICE']
                );
            }
            return $flights;
        }
    }


    function updateData($username, $password)
    {

        $servername = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "trips";

        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create connection
        $conn = new mysqli($servername, $user, $pass, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE USERS SET password='$newPassword' WHERE username='$username'";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }

        $conn->close();
    }
}
