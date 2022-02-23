<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$name = $_POST["name"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];
$repwd = $_POST["repwd"];

if (isset($_POST["submit"])) {

    if (emptyInputAdminRegister($name, $email, $pwd, $repwd) !== false) {
        header("location: ../admin/main/register.php?error=emptyinput");
        exit();
    }

    if (invaliduName($name) !== false) {
        header("location: ../admin/main/register.php?error=invaliduname");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../admin/main/register.php?error=invalidemail");
        exit();
    }

    if (invalidPwd($pwd) == false) {
        header("location: ../admin/main/register.php?error=invalidpwd");
        exit();
    }

    if (pwdMatch($pwd, $repwd) !== false) {
        header("location: ../admin/main/register.php?error=pwddontmatch");
        exit();
    }

    if (adminuNameExists($conn, $name, $email) !== false) {
        header("location: ../admin/main/register.php?error=unametaken");
        exit();
    } else {
        createAdmin($conn, $name, $email, $pwd);
    }
} else {
    header("location: ../admin/main/register.php");
    exit();
}
