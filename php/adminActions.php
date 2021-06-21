<?php

require('dbConnecter.php');

if ($_POST['location_id']) {
    $id = (int)$_POST['location_id'];
    if ($_POST['accept'] === 'yes') {
        $updateSql = "UPDATE location SET flag = 1 WHERE id = $id";
    } else if ($_POST['accept'] === 'no') {
        $updateSql = "UPDATE location SET flag = 2 WHERE id = $id";
    }

    $result = $conn->query($updateSql) or die("error in selecting data from location table: " . $conn->error);
    // close db connection
    $conn->close();
}


