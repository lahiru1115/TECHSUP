<?php session_start();

require_once('dbh.inc.php');
require_once('functions.inc.php');

$userId = $_SESSION["userId"];
$title = $_POST["title"];
$description = $_POST["description"];
$status = $_POST["status"];

if (isset($_POST["submit"])) {

    if (emptyInputSupport($title, $description) !== false) {
        header("location: ../user/issues/addIssue.php?error=emptyinput");
        exit();
    }

    submitIssue($conn, $userId, $title, $description, $status);
} else {
    header("location: ../support/supportticket.php");
    exit();
}
