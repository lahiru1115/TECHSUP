<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Add Issue</title>
    <style>
        <?php include "../../css/outline.css";
        include "../../css/forms.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h">
        <div class="heading">
            <h1>Add new issue</h1>
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
                <a href="#" class="disabled">
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
                <?php
                $userId = $_SESSION["userId"];
                ?>
                <a href="../profile/updateUser.php?userId=<?php echo $userId; ?>">
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
        <form method="post" action="../../includes/addIssue.inc.php">
            <table>
                <tr>
                    <td><label>Title</label></td>
                    <td><input type="text" placeholder="Enter a title" name="title" id="title"></td>
                </tr>
                <tr>
                    <td><label>Describe your issue</label></td>
                    <td><textarea name="description" rows="10" cols="150" placeholder="Please describe your issue here"></textarea></td>
                </tr>
                <!-- Hidden row -->
                <tr style="display: none;">
                    <td><label>Status</label></td>
                    <td><select name="status" id="status">
                            <option value=false selected>Pending</option>
                            <option value=true disabled>Solved</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="submit">SUBMIT</button></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p class=\"warning\">Fill in all the fields!</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p class=\"warning\">Something went wrong!</p>";
            } else if ($_GET["error"] == "cantdelete") {
                echo "<p class=\"warning\">Can't delete the issue at the moment!</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p class='success'>Message Sent!</p>";
            } else if ($_GET["error"] == "deleted") {
                echo "<p class='success'>Issue details deleted!</p>";
            }
        }
        ?>
    </div>

</body>

</html>