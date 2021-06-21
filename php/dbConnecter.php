<?php

require "config.php";

// config data
define('SERVER_NAME', $servername);
define('USERNAME', $username);
define('PASSWORD', $password);
define('DB_NAME', $dbname);

try {
    // Create connection
    $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
    mysqli_set_charset($conn, 'utf8');
} catch (Exception $ex) {
    echo json_encode($ex->getMessage());
} catch (Error $er) {
    echo json_encode($er->getMessage());
}