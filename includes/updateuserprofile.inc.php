<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$userId = $_POST["userId"];
$userName = $_POST["userName"];
$userEmail = $_POST["userEmail"];
$userPhone = $_POST["userPhone"];
$pwd = $_POST["pwd"];
$repwd = $_POST["repwd"];

if (isset($_POST["submit"])) {

    // if (emptyInputSignup($userName, $userEmail, $userPhone, $pwd, $repwd) !== false) {
    //     header("location: ../user/profile/updateUser.php?error=emptyinput");
    //     exit();
    // }

    if (invaliduName($userName) !== false) {
        header("location: ../profile/updateUser.php?error=invaliduname");
        exit();
    }

    if (invalidEmail($userEmail) !== false) {
        header("location: ../profile/updateUser.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $repwd) !== false) {
        header("location: ../profile/updateUser.php?error=pwddontmatch");
        exit();
    }

    updateUserDataProfile($conn, $userId, $userName, $userEmail, $userPhone, $pwd);
} else {
    header("location: ../profile/updateUser.php");
    exit();
}
