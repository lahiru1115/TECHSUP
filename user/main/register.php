<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Register</title>
    <style>
        <?php include "../../css/userLoginReg.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h"></nav>

    <nav class="nav-v">
        <div class="logo">
            <a href="../../index.php">
                <img src="../../assets/techsup-logo-white.png" width="225px">
            </a>
        </div>
    </nav>

    <div class="user userReg">
        <h1>Create new user account</h1><br>
        <form action="../../includes/userRegister.inc.php" method="post">
            <label>Username</label>
            <input type="text" placeholder="Enter your username" name="name" id="name">
            <label>Email</label>
            <input type="text" placeholder="Enter your email" name="email" id="email">
            <label>Phone Number</label>
            <input type="tel" placeholder="Enter your phone number" name="pNumber" id="pNumber">
            <label>Password</label>
            <input type="password" placeholder="Enter your password" name="pwd" id="pwd">
            <label>Re-enter Password</label>
            <input type="password" placeholder="Re-Enter your password" name="repwd" id="repwd">
            <button type="submit" name="submit">REGISTER</button>
            <h3>Already have an account ?&nbsp;&nbsp;&nbsp;<a href="login.php">Login</a></h3>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p class=\"warning\">Fill in all the fields!</p>";
            } else if ($_GET["error"] == "invaliduname") {
                echo "<p class=\"warning\">Invalid Username!</p>";
            } else if ($_GET["error"] == "invalidemail") {
                echo "<p class=\"warning\">Invalid Email!</p>";
            } else if ($_GET["error"] == "invalidpwd") {
                echo "<p class=\"warning\">Password must be at least 4 characters!</p>";
            } else if ($_GET["error"] == "pwddontmatch") {
                echo "<p class=\"warning\">Passwords don't match!</p>";
            } else if ($_GET["error"] == "unametaken") {
                echo "<p class=\"warning\">Username or email is already taken!</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p class=\"warning\">Something went wrong!</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p class=\"success\">You have registered!</p>";
            }
        }
        ?>
    </div>

</body>

</html>