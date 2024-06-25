<?php

require_once('dbh.inc.php');
require_once('functions.inc.php');

$userId = $_POST["userId"];
// $userName = $_POST["userName"];
// $userEmail = $_POST["userEmail"];
// $userPhone = $_POST["userPhone"];
$pwd = $_POST["pwd"];
$repwd = $_POST["repwd"];

if (isset($_POST["submit"])) {

    if (userUpdateEmptyInput($pwd, $repwd) !== false) {
        header("location: ../user/profile/updateUser.php?error=emptyInput");
        exit();
    }

    // if (invaliduName($userName) !== false) {
    //     header("location: ../profile/updateUser.php?error=invaliduName");
    //     exit();
    // }

    // if (invalidEmail($userEmail) !== false) {
    //     header("location: ../profile/updateUser.php?error=invalidEmail");
    //     exit();
    // }

    if (pwdMatch($pwd, $repwd) !== false) {
        header("location: ../profile/updateUser.php?error=pwdDontMatch");
        exit();
    }

    userUpdateProfile($conn, $userId, $pwd);
} else {
    header("location: ../profile/updateUser.php");
    exit();
}
