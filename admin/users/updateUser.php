<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
$row = updateGet($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit User</title>
    <style>
        <?php include "../../css/adminOutline.css"; ?><?php include "../../css/adminForm.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h">
        <div class="heading">
            <h1>Edit User</h1>
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
                <a href="viewUser.php">
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
        <form action="../../includes/updateUser.inc.php" name=myform method="post">
            <table>
                <tr>
                    <td><label>User Id</label></td>
                    <td><input type="text" name="userId" id="userId" placeholder="User Id" value="<?php echo $row['userId']; ?>" disabled></td>
                </tr>
                <tr>
                    <td><label>User Name</label></td>
                    <td><input type="text" name="userName" id="userName" placeholder="User Name" value="<?php echo $row['userName']; ?>"></td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="email" name="userEmail" id="userEmail" placeholder="Email" value="<?php echo $row['userEmail']; ?>"></td>
                </tr>
                <tr>
                    <td><label>Phone no</label></td>
                    <td><input type="text" name="userPhone" id="userPhone" placeholder="Phone no" value="<?php echo $row['userPhone']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="submit">UPDATE</button></td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>