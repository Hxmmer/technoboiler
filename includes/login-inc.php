<?php

if (isset($_POST['submit'])) {

    $uid = $_POST['uid'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    require_once 'db-inc.php';
    require_once 'functions-inc.php';

    if (emptyInputLogin($uid, $password) !== false) {
        header('location: ../login-new.php?error=emptyInput');
        exit();
    }

    loginUser($conn, $uid, $mail, $password);
} else {
    header('location: ../index.php');
    exit();
}
