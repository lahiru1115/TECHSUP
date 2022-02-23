<?php

require_once('dbh.inc.php');
require_once('functions.inc.php');

$name = $_POST["name"];
$pwd = $_POST["pwd"];

if (isset($_POST["submit"])) {

    if (emptyInputAdminLogin($name, $pwd) !== false) {
        header("location: ../admin/main/login.php?error=emptyinput");
        exit();
    }

    loginAdmin($conn, $name, $pwd);
} else {
    header("location: ../admin/main/login.php");
    exit();
}
