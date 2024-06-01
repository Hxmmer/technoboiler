<?php


function emptyInputSignup($uid, $mail, $password, $passwordRepeat)
{
    $result = false;
    if (empty($uid) || empty($mail) || empty($password) || empty($passwordRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($uid)
{
    $result = false;
    if (!preg_match('/^[a-zA-Z0-9]*$/', $uid)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($mail)
{
    $result = false;
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidPasswordMatch($password, $passwordRepeat)
{
    $result = false;
    if ($password !== $passwordRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $uid, $mail)
{
    $sql = 'SELECT * FROM tb_user WHERE tb_user_uid = ? OR tb_user_email = ?;';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../login-new.php?error=stmtFailed');
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ss', $uid, $mail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $uid, $mail, $password)
{
    $sql = 'INSERT INTO tb_user (tb_user_uid, tb_user_email, tb_user_pwd) VALUES(?, ?, ?)';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../login-new.php?error=stmtCreateUserFailed');
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, 'sss', $uid, $mail, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../login-new.php?error=none');
    exit();
}

function emptyInputLogin($uid, $password)
{
    $result = false;
    if (empty($uid) || empty($mail) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $uid, $password)
{
    $uidExist = uidExists($conn, $uid, $uid);

    if ($uidExist === false) {
        header('location: ../login-new.php?error=wrongLogin');
        exit();
    }

    /** @var string $passwordHashed */
    $passwordHashed = ['tb_user_pwd'];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
        header('location: ../login-new.php?error=wrongLogin');
        exit();
    }
    elseif ($checkPassword === true) {
        session_start();
        $_SESSION['userid'] = $uidExist['tb_user_id'];
        $_SESSION['useruid'] = $uidExist['tb_user_uid'];
        header('location: ../index.php');
        exit();
    }
}
