<?php

$servername = "ec2-44-199-143-43.compute-1.amazonaws.com";

// REPLACE with your Database name
$dbname = "d1b25dtb48u8jr";
// REPLACE with Database user
$username = "gwvynzijwcgjel";
// REPLACE with Database user password
$password = "e15b68b54b4f9ecd2c8eed18a17d455cc54562336bd448304fd8e0870c28ac70";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "miegodogaja";

$api_key=$value1 = $value2 = $value3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $value1 = test_input($_POST["value1"]);
        $value2 = test_input($_POST["value2"]);
        $value3 = test_input($_POST["value3"]);
        
        // Create connection
        $conn = pg_connect($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO bayi (suhu, suara, detak_jantung)
        VALUES ('" . $value1 . "', '" . $value2 . "', '" . $value3 . "')";
        
        if ($conn->pg_query($conn,$sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>