<?php

require_once('dbh.inc.php');
require_once('functions.inc.php');

$name = $_POST["name"];
$pwd = $_POST["pwd"];

if (isset($_POST["submit"])) {

    if (userLoginEmptyInput($name, $pwd) !== false) {
        header("location: ../user/main/login.php?error=emptyInput");
        exit();
    }
    if ($name == "admin@2") {
        header("location: ../admin/main/login.php");
    } else {
        userLogin($conn, $name, $pwd);
    }
} else {
    header("location: ../user/main/login.php");
    exit();
}
