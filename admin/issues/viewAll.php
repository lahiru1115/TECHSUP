<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
$row = adminGetIssueDataAll($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | View Issue</title>
    <style>
        <?php include "../../css/dashboardOutline.css";
        include "../../css/details.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h-back"></nav>

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
                if (isset($_SESSION["adminId"])) {
                    echo "<h1>" . $_SESSION["adminName"] . "</h1>";
                }
                ?>
            </div>
            <div>
                <a href="../main/dashboard.php">
                    <div class="item click">
                        <img src="../../assets/home-outline-white-24dp.png">
                        <span>Home</span>
                    </div>
                </a>
                <br>
                <a href="viewIssue.php">
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
                <a href="../main/register.php">
                    <div class="item click">
                        <img src="../../assets/addAdmin-outline-white-24dp">
                        <span>Create new admin</span>
                    </div>
                </a>
            </div>
            <a href="../../includes/adminLogout.inc.php">
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
                <th><label>Issue Id</label></th>
                <td><span><?php echo $row['issueId']; ?></span></td>
            </tr>
            <tr>
                <th><label>Title</label></th>
                <td><span><?php echo $row['title']; ?></span></td>
            </tr>
            <tr>
                <th><label>Description</label></th>
                <td><span><?php echo $row['description']; ?></span></td>
            </tr>
            <tr>
                <th><label>Date & Time</label></th>
                <td><span><?php echo $row['timestamp']; ?></span></td>
            </tr>
            <tr>
                <th><label>User Id</label></th>
                <td><span><?php echo $row['userId']; ?></span></td>
            </tr>
            <tr>
                <th><label>User Name</label></th>
                <td><span><?php echo $row['userName']; ?></span></td>
            </tr>
            <tr>
                <th><label>User Email</label></th>
                <td><span><?php echo $row['userEmail']; ?></span></td>
            </tr>
            <tr>
                <th><label>User Phone</label></th>
                <td><span><?php echo $row['userPhone']; ?></span></td>
            </tr>
            <tr>
                <th><label>Status</label></th>
                <td><span><?php echo $row['status']; ?></span></td>
            </tr>
        </table>
        <br><br>
        <div class="btnGroup">
            <div>
                <a href="viewIssue.php" id="btnA">
                    <div class="btn">
                        <img src="../../assets/arrowBackIOSNew-outline-white-18dp.png">
                        &nbsp;
                        <span>Back</span>
                    </div>
                </a>
            </div>
            <div>
                <a href="updateIssue.php?issueId=<?php echo $row['issueId']; ?>" id="btnA">
                    <div class="btn">
                        <img src="../../assets/edit-outline-white-24dp.png">
                        &nbsp;
                        <span>Edit</span>
                    </div>
                </a>
            </div>
            <div>
                <a href="deleteIssue.php?issueId=<?php echo $row['issueId']; ?>" id="btnA">
                    <div class="btn">
                        <img src="../../assets/delete-outline-white-24dp.png">
                        &nbsp;
                        <span>Delete</span>
                    </div>
                </a>
            </div>
        </div>

    </div>

</body>

</html>