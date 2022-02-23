<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$userId = $_POST["userId"];
$userName = $_POST["userName"];
$userEmail = $_POST["userEmail"];
$userPhone = $_POST["userPhone"];

if (isset($_POST["submit"])) {

    if (emptyInputUpdate($userName, $userEmail, $userPhone) !== false) {
        header("location: ../admin/users/viewUser.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($userEmail) !== false) {
        header("location: ../admin/users/viewUser.php?error=invalidemail");
        exit();
    }

    updateUserData($conn, $userId, $userName, $userEmail, $userPhone);
} else {
    header("location: ../admin/users/viewUser.php");
    exit();
}
