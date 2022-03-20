<?php session_start(); ?>

<?php
require_once('../../includes/dbh.inc.php');
require_once('../../includes/functions.inc.php');
$row = adminGetIssueDataUpdate($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit Issue</title>
    <style>
        <?php include "../../css/dashboardOutline.css";
        include "../../css/forms.css"; ?>
    </style>
</head>

<body>

    <nav class="nav-h-back"></nav>

    <nav class="nav-h">
        <div class="heading">
            <h1>Edit Issue</h1>
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
            <a href="../../includes/logoutAdmin.inc.php">
                <div class="item logout">
                    <img src="../../assets/logout-outline-white-24dp.png">
                    <span>Logout</span>
                </div>
            </a>
        </div>
    </nav>

    <div class="body">
        <form action="../../includes/updateIssue.inc.php" method="post">
            <table>
                <tr>
                    <td><label>User Name</label></td>
                    <td><input type="text" name="userName" id="userName" placeholder="User Name" class="disabledInput" value="<?php echo $row['userName']; ?>" disabled></td>
                </tr>
                <tr>
                    <td><label>Issue Id</label></td>
                    <td><input type="text" name="issueId" id="issueId" placeholder="Issue Id" class="disabledInput" value="<?php echo $row['issueId']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label>Title</label></td>
                    <td><input type="text" name="title" id="title" placeholder="Title" class="disabledInput" value="<?php echo $row['title']; ?>" disabled></td>
                </tr>
                <tr>
                    <td><label>Description</label></td>
                    <td><textarea rows="10" cols="120" name="description" id="description" placeholder="Description" class="disabledInput" disabled><?php echo $row['description']; ?></textarea></td>
                </tr>
                <tr>
                    <td><label>Status</label></td>
                    <td><select name="status" id="status">
                            <option value=0 <?php if ($row['status'] == "Pending") echo 'selected="selected"'; ?>>Pending</option>
                            <option value=1 <?php if ($row['status'] == "Solved") echo 'selected="selected"'; ?>>Solved</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="submit">UPDATE</button></td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>