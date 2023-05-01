<?php

if (isset($_POST['submit'])) {


    $uid = $_POST['uid'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepead'];

    require_once 'db-inc.php';
    require_once 'functions-inc.php';

    if (emptyInputSignup($uid, $mail, $password, $passwordRepeat) !== false) {
        header('location: ../login-new.php?error=emptyInput');
        exit();
    }

    if (invalidUid($uid) !== false) {
        header('location: ../login-new.php?error=emptyUid');
        exit();
    }

    if (invalidEmail($mail) !== false) {
        header('location: ../login-new.php?error=emptyEmail');
        exit();
    }

    if (invalidPasswordMatch($password, $passwordRepeat) !== false) {
        header('location: ../login-new.php?error=passwordDoesNotMatch');
        exit();
    }

    if (uidExists($conn, $uid, $mail) !== false) {
        header('location: ../login-new.php?error=usernameTaken');
        exit();
    }

    createUser($conn, $uid, $mail, $password);
} else {
    header('location: ../login-new.php');
    exit();
}
