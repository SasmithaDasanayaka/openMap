<?php

require('dbConnecter.php');

if (!empty($_POST["dataObj"])) {
    $dataObj = $_POST["dataObj"];
    $lat = $dataObj["position"]["lat"];
    $lng = $dataObj["position"]["lng"];
    $des = $_POST["dataObj"]["des"];
    $age = $_POST["dataObj"]["age"];
    $race = $_POST["dataObj"]["race"];
    $gender = $_POST["dataObj"]["gender"];
    $religion = $_POST["dataObj"]["religion"];
    $disability = $_POST["dataObj"]["disability"];
    $socioeconomy = $_POST["dataObj"]["socioeconomy"];


    $insertSQL = "INSERT INTO location(id,latitude,longitude,description,flag,age,race,gender,religion,disability,socioeconomic,createdAt) VALUES ('',?,?,?,0,?,?,?,?,?,?,NOW())";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $insertSQL);
    mysqli_stmt_bind_param($stmt, 'ddsdddddd', $lat, $lng, $des, $age, $race, $gender, $religion, $disability, $socioeconomy);
    mysqli_stmt_execute($stmt);
    $last_id = mysqli_insert_id($conn);

    // close db connection
    $conn->close();
    echo $last_id;
}
