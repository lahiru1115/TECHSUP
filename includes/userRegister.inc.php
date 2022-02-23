<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$name = $_POST["name"];
$email = $_POST["email"];
$pNumber = $_POST["pNumber"];
$pwd = $_POST["pwd"];
$repwd = $_POST["repwd"];

if (isset($_POST["submit"])) {

    if (emptyInputSignup($name, $email, $pNumber, $pwd, $repwd) !== false) {
        header("location: ../user/register.php?error=emptyinput");
        exit();
    }

    if (invaliduName($name) !== false) {
        header("location: ../user/register.php?error=invaliduname");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../user/register.php?error=invalidemail");
        exit();
    }

    if (invalidPwd($pwd) == false) {
        header("location: ../user/register.php?error=invalidpwd");
        exit();
    }

    if (pwdMatch($pwd, $repwd) !== false) {
        header("location: ../user/register.php?error=pwddontmatch");
        exit();
    }

    if (unameExists($conn, $name, $email) !== false) {
        header("location: ../user/register.php?error=unametaken");
        exit();
    } else {
        createUser($conn, $name, $email, $pNumber, $pwd);
    }
} else {
    header("location: ../user/register.php");
    exit();
}



// if ($name == "admin@2") {
//     createAdmin($conn, $name, $email, $pwd);
// }