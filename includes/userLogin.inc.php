<?php

require_once('dbh.inc.php');
require_once('functions.inc.php');

$name = $_POST["name"];
$pwd = $_POST["pwd"];

if (isset($_POST["submit"])) {

    if (emptyInputLogin($name, $pwd) !== false) {
        header("location: ../user/main/login.php?error=emptyinput");
        exit();
    }
    if ($name == "admin@2") {
        header("location: ../admin/main/login.php");
    } else {
        loginUser($conn, $name, $pwd);
    }
} else {
    header("location: ../user/main/login.php");
    exit();
}
