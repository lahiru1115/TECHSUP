<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Login</title>
    <style>
        <?php include "../../css/adminLogin.css"; ?>
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

    <div class="adminLogin">
        <h1>Admin Login</h1><br>
        <form method="post" action="../../includes/adminLogin.inc.php">
            <label>Username</label>
            <input type="text" placeholder="Enter your username" name="name" id="name">
            <label>Password</label>
            <input type="password" placeholder="Enter your password" name="pwd" id="pwd">
            <button type="submit" name="submit">LOGIN</button>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyInput") {
                echo "<p>Fill in all the fields!</p>";
            } else if ($_GET["error"] == "invalidLogin") {
                echo "<p>Invalid Username or Password!</p>";
            }
        }
        ?>
    </div>

</body>

</html>