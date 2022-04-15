<?php

require_once('dbh.inc.php');
require_once('functions.inc.php');

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$pwd = $_POST["pwd"];
$repwd = $_POST["repwd"];

if (isset($_POST["submit"])) {

    if (userRegisterEmptyInput($name, $email, $phone, $pwd, $repwd) !== false) {
        header("location: ../user/main/register.php?error=emptyInput");
        exit();
    }

    if (invaliduName($name) !== false) {
        header("location: ../user/main/register.php?error=invaliduName");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../user/main/register.php?error=invalidEmail");
        exit();
    }

    if (invalidPwd($pwd) == false) {
        header("location: ../user/main/register.php?error=invalidPwd");
        exit();
    }

    if (pwdMatch($pwd, $repwd) !== false) {
        header("location: ../user/main/register.php?error=pwdDontMatch");
        exit();
    }

    if (useruNameEmailExists($conn, $name, $email) !== false) {
        header("location: ../user/main/register.php?error=uNameTaken");
        exit();
        
    } else {
        userRegister($conn, $name, $email, $phone, $pwd);
    }
} else {
    header("location: ../user/main/register.php");
    exit();
}