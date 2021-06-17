<?php

require "config.php";

if (!empty($_POST["dataObj"])) {
    $dataObj = $_POST["dataObj"];
    $lat = $dataObj["position"]["lat"];
    $lng = $dataObj["position"]["lng"];
    $des = $_POST["dataObj"]["des"];
    $tags = $_POST["dataObj"]["tags"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $insertSQL = "INSERT INTO location(latitude,longitude,description,flag) values ($lat,$lng ,'$des',0)";
    $conn->query($insertSQL) or die("error in inserting data to location table: " . $insertSQL);
    $last_id = $conn->insert_id;

    foreach ($tags as $tag) {
        $insetTagSQL = "INSERT INTO location_tag(location_id,tag_id) VALUES ( $last_id,$tag)";
        $conn->query($insetTagSQL) or die("error in inserting data to location_tag table: " . $insetTagSQL);
    }
    // close db connection
    $conn->close();
    echo $last_id;
}
