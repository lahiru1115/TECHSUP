<?php session_start();

require_once('dbh.inc.php');
require_once('functions.inc.php');

$userId = $_SESSION["userId"];
$title = $_POST["title"];
$description = $_POST["description"];
$status = $_POST["status"];

if (isset($_POST["submit"])) {

    if (userAddIssueEmptyInput($title, $description) !== false) {
        header("location: ../user/issues/addIssue.php?error=emptyInput");
        exit();
    }

    addIssue($conn, $userId, $title, $description, $status);
} else {
    header("location: ../support/supportticket.php");
    exit();
}
