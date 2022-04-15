<?php
session_start();
session_destroy();
header("location: ../user/main/login.php");
exit();
