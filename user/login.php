<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Login</title>
    <style>
        <?php include "../css/userLoginReg.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h"></nav>

    <nav class="nav-v">
        <div class="logo">
            <a href="../index.php">
                <img src="../assets/techsup-logo-white.png" width="225px">
            </a>
        </div>
    </nav>

    <div class="user userLogin">
        <h1>User Login</h1><br>
        <form method="post" action="../includes/userLogin.inc.php">
            <label>Username</label>
            <input type="text" placeholder="Enter your username" name="name" id="name">
            <label>Password</label>
            <input type="password" placeholder="Enter your password" name="pwd" id="pwd">
            <button type="submit" name="submit">LOGIN</button>
            <h3>Don't have an account ?&nbsp;&nbsp;&nbsp;<a href="register.php">Register</a></h3>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p class=\"warning\">Fill in all the fields!</p>";
            } else if ($_GET["error"] == "invalidlogin") {
                echo "<p class=\"warning\">Invalid Username or Password!</p>";
            } else if ($_GET["error"] == "wrongpassword") {
                echo "<p class=\"warning\">Invalid Username or Password!</p>";
            } else if ($_GET["error"] == "deleted") {
                echo "<p class='success'>Your account was deleted!</p>";
            }
        }
        ?>
    </div>

</body>

</html>