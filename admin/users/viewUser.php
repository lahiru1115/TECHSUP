<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Users</title>
    <style>
        <?php include "../../css/adminOutline.css";
        include "../../css/adminTable.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h">
        <div class="heading">
            <h1>User Management</h1>
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
                <a href="../issues/viewIssue.php">
                    <div class="item click">
                        <img src="../../assets/issue-outline-white-24dp.png">
                        <span>Issue Management</span>
                    </div>
                </a>
                <br>
                <a href="#" class="disabled">
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
            <a href="../../includes/logoutAdmin.inc.php">
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
                    <th>User Id</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Phone</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = getUserData($conn);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['userId']; ?></td>
                            <td><?php echo $row['userName']; ?></td>
                            <td><?php echo $row['userEmail']; ?></td>
                            <td><?php echo $row['userPhone']; ?></td>
                            <td><a href="updateUser.php?userId=<?php echo $row['userId']; ?>"><img src="../../assets/edit-outline-white-24dp.png"></a></td>
                            <td><a href="deleteUser.php?userId=<?php echo $row['userId']; ?>" onclick="return confirm('Do you really want to delete this record?')"><img src="../../assets/delete-outline-white-24dp.png"></a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p class=\"warning\">Fill in all the fields!</p>";
            } else if ($_GET["error"] == "invaliduname") {
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
                echo "<p class=\"success\">User details Deleted!</p>";
            }
        }
        ?>
    </div>

</body>

</html>