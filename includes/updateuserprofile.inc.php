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

    if (emptyInputSignup($userName, $userEmail, $userPhone, $pwd, $repwd) !== false) {
        header("location: ../user/profile/profile.php?error=emptyinput");
        exit();
    }

    if (invaliduName($userName) !== false) {
        header("location: ../profile/profile.php?error=invaliduname");
        exit();
    }

    if (invalidEmail($userEmail) !== false) {
        header("location: ../profile/profile.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $repwd) !== false) {
        header("location: ../profile/profile.php?error=pwddontmatch");
        exit();
    }

    updateUserDataProfile($conn, $usersId, $userName, $userEmail, $userPhone,  $pwd);
} else {
    header("location: ../profile/profile.php");
    exit();
}
