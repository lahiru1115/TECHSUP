<?php

require_once('dbh.inc.php');
require_once('functions.inc.php');

$name = $_POST["name"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];
$repwd = $_POST["repwd"];

if (isset($_POST["submit"])) {

    if (adminRegisterEmptyInput($name, $email, $pwd, $repwd) !== false) {
        header("location: ../admin/main/register.php?error=emptyInput");
        exit();
    }

    if (invaliduName($name) !== false) {
        header("location: ../admin/main/register.php?error=invaliduName");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../admin/main/register.php?error=invalidEmail");
        exit();
    }

    if (invalidPwd($pwd) == false) {
        header("location: ../admin/main/register.php?error=invalidPwd");
        exit();
    }

    if (pwdMatch($pwd, $repwd) !== false) {
        header("location: ../admin/main/register.php?error=pwdDontMatch");
        exit();
    }

    if (adminuNameEmailExists($conn, $name, $email) !== false) {
        header("location: ../admin/main/register.php?error=uNameTaken");
        exit();
    } else {
        adminRegister($conn, $name, $email, $pwd);
    }
} else {
    header("location: ../admin/main/register.php");
    exit();
}
