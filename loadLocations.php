<?php

require "config.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectSQL = "SELECT * FROM location INNER JOIN location_tag ON location.id=location_tag.location_id WHERE location.flag = 1 ";
$result = $conn->query($selectSQL) or die("error in selecting data from location table: " . $conn->connect_errno);
$sendData = [];

while ($data = mysqli_fetch_array($result)) {
    $sendData[] = $data;
}

// close db connection
$conn->close();
echo json_encode($sendData);
