<?php

require('dbConnecter.php');

$flag = (int)$_GET['flag'];
$selectSQL = "SELECT * FROM location INNER JOIN location_tag ON location.id=location_tag.location_id WHERE location.flag = $flag ";
$result = $conn->query($selectSQL) or die("error in selecting data from location table: " . $conn->error);
$sendData = [];

while ($data = mysqli_fetch_array($result)) {
    $sendData[] = $data;
}

// close db connection
$conn->close();
echo json_encode($sendData);
