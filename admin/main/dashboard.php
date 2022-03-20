<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Home</title>
    <style>
        <?php include "../../css/dashboardOutline.css";
        include "../../css/DashboardMain.css";
        include "../../css/tables.css" ?>
    </style>
</head>

<body>

    <nav class="nav-h-back"></nav>

    <nav class="nav-h">
        <div class="heading">
            <h1>Home</h1>
        </div>
    </nav>

    <nav class="nav-v">
        <div class="logo">
            <a href="#">
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
                <a href="#" class="disabled">
                    <div class="item click">
                        <img src="../../assets/home-outline-white-24dp.png">
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
                <a href="register.php">
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
        <div class="adminPendingIssues">
            <h2>Pending Issues</h2>
            <table>
                <thead>
                    <tr>
                        <th class="thLeft">Issue Id</th>
                        <th class="thLeft">User Name</th>
                        <th class="thLeft">Title</th>
                        <th class="thLeft descr">Description</th>
                        <th class="thLeft">Date & Time</th>
                        <th class="thLeft">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = adminPendingIssues($conn);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['issueId']; ?></td>
                                <td><?php echo $row['userName']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php if (strlen($row['description']) > 100) {
                                        echo substr($row['description'], 0, 100) . "...";
                                    } else {
                                        echo $row['description'];
                                    } ?></td>
                                <td><?php echo $row['timestamp']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="seeMore">
                <a href="../issues/viewIssue.php">See more...</a>
            </div>
        </div>
        <div class="adminSolvedIssues topMargin">
            <h2>Solved Issues</h2>
            <table>
                <thead>
                    <tr>
                        <th class="thLeft">Issue Id</th>
                        <th class="thLeft">User Name</th>
                        <th class="thLeft">Title</th>
                        <th class="thLeft descr">Description</th>
                        <th class="thLeft">Date & Time</th>
                        <th class="thLeft">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = adminSolvedIssues($conn);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['issueId']; ?></td>
                                <td><?php echo $row['userName']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php if (strlen($row['description']) > 100) {
                                        echo substr($row['description'], 0, 100) . "...";
                                    } else {
                                        echo $row['description'];
                                    } ?></td>
                                <td><?php echo $row['timestamp']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="seeMore">
                <a href="../issues/viewIssue.php">See more...</a>
            </div>
        </div>
        <div class="mostIssues topMargin">
            <h2>Most Issues by User</h2>
            <table>
                <thead>
                    <tr>
                        <th class="thLeft">User Id</th>
                        <th class="thLeft">User Name</th>
                        <th class="thLeft">User Email</th>
                        <th class="thLeft">User Phone</th>
                        <th class="thLeft">No of Issues</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = adminMostIssues($conn);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['userId']; ?></td>
                                <td><?php echo $row['userName']; ?></td>
                                <td><?php echo $row['userEmail']; ?></td>
                                <td><?php echo $row['userPhone']; ?></td>
                                <td><?php echo $row['COUNT(issueId)']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="seeMore">
                <a href="../users/viewUser.php">See more...</a>
            </div>
        </div>
    </div>

</body>

</html>