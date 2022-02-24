<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
$row = issueGet($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | View Issue</title>
    <style>
        <?php include "../../css/adminOutline.css";
        include "../../css/adminForm.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h">
        <div class="heading">
            <h1>View Issue</h1>
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
                <a href="addIssue.php">
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
                <a href="../profile/updateUser.php">
                    <div class="item click">
                        <img src="../../assets/manageAccounts-outline-white-24dp">
                        <span>Settings</span>
                    </div>
                </a>
            </div>
            <a href="../../includes/logoutUser.inc.php">
                <div class="item logout">
                    <img src="../../assets/logout-outline-white-24dp.png">
                    <span>Logout</span>
                </div>
            </a>
        </div>
    </nav>

    <div class="body">
        <table>
            <tr>
                <td><label>Issue Id</label></td>
                <td><input type="text" name="issueId" id="issueId" placeholder="Issue Id" value="<?php echo $row['issueId']; ?>" disabled></td>
            </tr>
            <tr>
                <td><label>Title</label></td>
                <td><input type="text" name="title" id="title" placeholder="Title" value="<?php echo $row['title']; ?>" disabled></td>
            </tr>
            <tr>
                <td><label>Description</label></td>
                <td><textarea name="description" rows="10" cols="150" disabled><?php echo $row['description']; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="viewIssue.php" id="backA">
                        <div class="backBt">Back</div>
                    </a>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>