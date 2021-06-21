<?php

require('dbConnecter.php');

if (!empty($_POST["dataObj"])) {
    $dataObj = $_POST["dataObj"];
    $lat = $dataObj["position"]["lat"];
    $lng = $dataObj["position"]["lng"];
    $des = $_POST["dataObj"]["des"];
    $tags = $_POST["dataObj"]["tags"];


    $insertSQL = "INSERT INTO location(id,latitude,longitude,description,flag,createdAt) VALUES ('',?,?,?,0,NOW())";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $insertSQL);
    mysqli_stmt_bind_param($stmt, 'dds', $lat, $lng, $des);
    mysqli_stmt_execute($stmt);
    $last_id = mysqli_insert_id($conn);

    foreach ($tags as $tag) {
        $insetTagSQL = "INSERT INTO location_tag(location_id,tag_id) VALUES ( $last_id,$tag)";
        $conn->query($insetTagSQL) or die("error in inserting data to location_tag table: " . $row);
    }
    // close db connection
    $conn->close();
    echo $last_id;
}
