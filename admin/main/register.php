<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Register</title>
    <style>
        <?php include "../../css/dashboardOutline.css";
        include "../../css/forms.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h-back"></nav>

    <nav class="nav-h">
        <div class="heading">
            <h1>Create new admin</h1>
        </div>
    </nav>

    <nav class="nav-v">
        <div class="logo">
            <a href="dashboard.php">
                <img src="../../assets/techsup-logo-white.png" width="225px">
            </a>
        </div>
        <div class="menu">
            <div class="item profile">
                <img src="../../assets/profile.png" width="36px">
                <?php
                if (isset($_SESSION["adminId"])) {
                    echo "<h1>" . $_SESSION["adminName"] . "</h1>";
                }
                ?>
            </div>
            <div>
                <a href="../main/dashboard.php">
                    <div class="item click">
                        <img src="../../assets//home-outline-white-24dp.png">
                        <span>Home</span>
                    </div>
                </a>
                <br>
                <a href="../issues/viewIssue.php">
                    <div class="item click">
                        <img src="../../assets/issue-outline-white-24dp.png">
                        <span>Issue Management</span>
                    </div>
                </a>
                <br>
                <a href="../users/viewUser.php">
                    <div class="item click">
                        <img src="../../assets/users-outline-white-24dp.png">
                        <span>User Management</span>
                    </div>
                </a>
                <br>
                <a href="#" class="disabled">
                    <div class="item click">
                        <img src="../../assets/addAdmin-outline-white-24dp">
                        <span>Create new admin</span>
                    </div>
                </a>
            </div>
            <a href="../../includes/logoutAdmin.inc.php">
                <div class="item logout">
                    <img src="../../assets/logout-outline-white-24dp.png">
                    <span>Logout</span>
                </div>
            </a>
        </div>
    </nav>

    <div class="body">
        <form method="post" action="../../includes/adminRegister.inc.php">
            <table>
                <tr>
                    <td><label>Username</label></td>
                    <td><input type="text" placeholder="Enter your username" name="name" id="name"></td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="text" placeholder="Enter your email" name="email" id="email"></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" placeholder="Enter your password" name="pwd" id="pwd"></td>
                </tr>
                <tr>
                    <td><label>Re-enter Password</label></td>
                    <td><input type="password" placeholder="Re-enter your password" name="repwd" id="repwd"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="submit">REGISTER</button></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyInput") {
                echo "<p class=\"warning\">Fill in all the fields!</p>";
            } else if ($_GET["error"] == "invaliduName") {
                echo "<p class=\"warning\">Invalid Username!</p>";
            } else if ($_GET["error"] == "invalidEmail") {
                echo "<p class=\"warning\">Invalid Email!</p>";
            } else if ($_GET["error"] == "invalidPwd") {
                echo "<p class=\"warning\">Password must be at least 4 characters!</p>";
            } else if ($_GET["error"] == "pwdDontMatch") {
                echo "<p class=\"warning\">Passwords don't match!</p>";
            } else if ($_GET["error"] == "uNameTaken") {
                echo "<p class=\"warning\">Username or email is already taken!</p>";
            } else if ($_GET["error"] == "stmtFailed") {
                echo "<p class=\"warning\">Something went wrong!</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p class='success'>You have registered!</p>";
            }
        }
        ?>
    </div>

</body>

</html>