<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Issues</title>
    <style>
        <?php include "../../css/outline.css";
        include "../../css/tables.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h">
        <div class="heading">
            <h1>Your Issues</h1>
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
                <a href="#" class="disabled">
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
        <table>
            <thead>
                <tr>
                    <th class="thLeft">Issue Id</th>
                    <th class="thLeft">Title</th>
                    <th class="thLeft">Description</th>
                    <th class="thLeft">Date & Time</th>
                    <th class="thLeft">Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userId = $_SESSION['userId'];
                $result = yourIssues($conn, $userId);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['issueId']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['timestamp']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><a href="deleteIssue.php?issueId=<?php echo $row['issueId']; ?>" onclick="return confirm('Do you really want to delete this issue?')"><img src="../../assets/delete-outline-white-24dp.png"></a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "cantupdate") {
                echo "<p class=\"warning\">Can't update the issue at the moment!</p>";
            } else if ($_GET["error"] == "cantdelete") {
                echo "<p class=\"warning\">Can't delete the issue at the moment!</p>";
            } else if ($_GET["error"] == "notworking") {
                echo "<p class=\"success\">There are no issues available!</p>";
            } else if ($_GET["error"] == "deleted") {
                echo "<p class=\"success\">Issue details Deleted!</p>";
            }
        }
        ?>
    </div>

</body>

</html>