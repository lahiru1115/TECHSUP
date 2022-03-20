<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$issueId = $_POST["issueId"];
$status = $_POST["status"];

if (isset($_POST["submit"])) {
    adminUpdateIssue($conn, $issueId, $status);
} else {
    header("location: ../admin/issue/viewIssue.php");
    exit();
}
