<?php
require('config.php');

$error =array();
if (!empty($_POST['username'] && !empty($_POST['password']))) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === $admin_username && $password === $admin_password) {
        session_start();
        $_SESSION['is_user_set'] = true;
        header('location:php/admin.php');
        exit();
    }
    $error = 'Failed authenticate';
    echo 'not validate';
}