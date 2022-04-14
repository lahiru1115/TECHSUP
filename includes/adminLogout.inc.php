<?php
session_start();
session_destroy();
header("location: ../admin/main/login.php");
exit();
