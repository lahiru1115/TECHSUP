<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Login</title>
    <style>
        <?php include "../../css/adminLogin.css"; ?>
    </style>
</head>

<body>
    <div class="adminLogin">
        <h1>Admin Login</h1><br>
        <form name="adform" method="post" action="../../includes/adminLogin.inc.php">
            <label>Username</label>
            <input type="text" placeholder="Enter your username" name="name" id="name">
            <label>Password</label>
            <input type="password" placeholder="Enter your password" name="pwd" id="pwd">
            <button type="submit" name="submit">LOGIN</button>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all the fields!</p>";
            } else if ($_GET["error"] == "invalidlogin") {
                echo "<p>Invalid Username or Password!</p>";
            } else if ($_GET["error"] == "wrongpassword") {
                echo "<p>Invalid Username or Password!</p>";
            }
        }
        ?>
    </div>
</body>

</html>