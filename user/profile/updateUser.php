<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
$row = adminGetUserDataUpdate($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Update User</title>
    <style>
        <?php include "../../css/dashboardOutline.css";
        include "../../css/forms.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h-back"></nav>

    <nav class="nav-h">
        <div class="heading">
            <h1>Update User</h1>
        </div>
    </nav>

    <nav class="nav-v">
        <div class="logo">
            <a href="../main/dashboard.php">
                <img src="../../assets/techsup-logo-white.png" width="225px">
            </a>
        </div>
        <div class="menu">
            <div class="item profile">
                <img src="../../assets/profile.png" width="36px">
                <?php
                if (isset($_SESSION["userId"])) {
                    echo "<h1>" . $_SESSION["userName"] . "</h1>";
                }
                ?>
            </div>
            <div>
                <a href="../issues/addIssue.php">
                    <div class="item click">
                        <img src="../../assets/add-outline-white-24dp">
                        <span>Add Issue</span>
                    </div>
                </a>
                <br>
                <a href="../issues/viewIssue.php">
                    <div class="item click">
                        <img src="../../assets/issue-outline-white-24dp.png">
                        <span>Your Issues</span>
                    </div>
                </a>
                <br>
                <a href="#" class="disabled">
                    <div class="item click">
                        <img src="../../assets/manageAccounts-outline-white-24dp">
                        <span>Settings</span>
                    </div>
                </a>
            </div>
            <a href="../../includes/logout.inc.php">
                <div class="item logout">
                    <img src="../../assets/logout-outline-white-24dp.png">
                    <span>Logout</span>
                </div>
            </a>
        </div>
    </nav>

    <div class="body">
        <form action="../../includes/updateUserProfile.inc.php" method="post">
            <table>
                <tr>
                    <td><label>User Id</label></td>
                    <td><input type="text" name="userId" id="userId" placeholder="User Id" value="<?php echo $row['userId']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label>User Name</label></td>
                    <td><input type="text" name="userName" id="userName" placeholder="User Name" value="<?php echo $row['userName']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="email" name="userEmail" id="userEmail" placeholder="Email" value="<?php echo $row['userEmail']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label>Phone no</label></td>
                    <td><input type="tel" name="userPhone" id="userPhone" placeholder="Phone no" value="<?php echo $row['userPhone']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" name="pwd" id="pwd" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><label>Re-enter Password</label></td>
                    <td><input type="password" name="repwd" id="repwd" placeholder="Re-Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="submit">UPDATE</button></td>
                </tr>
            </table>
        </form>
        <div class="del">
            <a href="deleteUser.php?userId=<?php echo $row['userId']; ?>" onclick="return confirm('Are you sure you want to delete your account?')"><button>Delete the Account</button></a>
        </div>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "invaliduname") {
                echo "<p class=\"warning\">Invalid Username!</p>";
            } else if ($_GET["error"] == "invalidemail") {
                echo "<p class=\"warning\">Invalid Email!</p>";
            } else if ($_GET["error"] == "cantupdate") {
                echo "<p class=\"warning\">Can't update the user at the moment!</p>";
            } else if ($_GET["error"] == "cantdelete") {
                echo "<p class=\"warning\">Can't delete the user at the moment!</p>";
            } else if ($_GET["error"] == "notworking") {
                echo "<p class=\"success\">There are no users available!</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p class=\"success\">User details Updated!</p>";
            } else if ($_GET["error"] == "deleted") {
                echo "<p class=\"success\">User account Deleted!</p>";
            }
        }
        ?>
    </div>

</body>

</html>