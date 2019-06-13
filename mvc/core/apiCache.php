<?php

class HomeModel
{

    private $conn;

    private $servername = "localhost";
    private $username = "root";
    private    $password = "";
    private $database = "trips";


    public function getCitiesByName($name)
    {

        //if($this->conn===null){
        $this->conn = mysqli_connect(
            $this->servername,
            $this->username,
            $this->password,
            $this->database
        );
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        //} 

        $sql = "SELECT name, description,image FROM CITIES WHERE name = '$name'";
        $result = $this->conn->query($sql);
        $cities = array();
        if (!isset($result->num_rows)) {
            return null;
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cities[] = array(
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'description' => $row['description']
                );
            }
        }
        $this->conn->close();

        //echo "<PRE>";
        //print_r($cities);
        //exit;

        return $cities;
    }

    function insertCity($name, $description, $image)
    {
        $description = str_replace("'", '`', $description);
        $name = str_replace("'", '`', $name);

        //if($this->conn===null){
        $this->conn = mysqli_connect(
            $this->servername,
            $this->username,
            $this->password,
            $this->database
        );
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        //} 




        $sql = "INSERT INTO CITIES (name, description, image)
			VALUES ('{$name}','{$description}','{$image}')
			";

        //echo $sql;

        if ($this->conn->query($sql) === TRUE) {
            //echo "City " .  $name. " created successfully";
        } else {
            echo "Error at inserting in table: " . $this->conn->error;
            echo "<br>";
        }
        $this->conn->close();
    }
}
