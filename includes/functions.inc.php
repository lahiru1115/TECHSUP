<?php

// Done
function emptyInputAdminRegister($name, $email, $pwd, $repwd)
{
    if (empty($name) || empty($email) || empty($pwd) || empty($repwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function invaliduName($name)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function invalidPwd($pwd)
{
    if (strlen($pwd) >= 4) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function pwdMatch($pwd, $repwd)
{
    if ($pwd !== $repwd) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function adminuNameExists($conn, $name, $email)
{
    $sql = "SELECT * FROM admin WHERE adminName = ? OR adminEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/main/register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// Done
function createAdmin($conn, $name, $email, $pwd)
{
    $sql = "INSERT INTO admin (adminName, adminEmail, adminPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/main/register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin/main/register.php?error=none");
    exit();
}

// Done
function emptyInputAdminLogin($name, $pwd)
{
    if (empty($name)  || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function getIssueData($conn)
{
    $sql = "SELECT user.*, issue.*, IF(status, 'Solved', 'Pending') status FROM issue, user WHERE issue.userId = user.userId;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        header("location: ../admin/main/viewIssue.php?error=notworking");
        exit();
    }
}

// Done
function getUserData($conn)
{
    $sql = "SELECT userId, userName, userEmail, userPhone FROM user";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        header("location: ../admin/users/viewUser.php?error=notworking");
        exit();
    }
}

// Done
function deleteIssue($conn)
{
    if (isset($_GET['issueId']) && is_numeric($_GET['issueId'])) {
        $issuesId = $_GET['issueId'];
        $sql = "DELETE FROM issue WHERE issueId='$issuesId';";

        $delete_issue = mysqli_query($conn, $sql);

        if ($delete_issue) {
            header("location: viewIssue.php?error=deleted");
            exit();
        } else {
            header("location: viewIssue.php?error=cantdelete");
            exit();
        }
    }
}

// Done
function uNameExists($conn, $name, $email)
{
    $sql = "SELECT * FROM user WHERE userName = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user/main/register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// Done
function emptyInputSignup($name, $email, $pNumber, $pwd, $repwd)
{
    if (empty($name) || empty($email) || empty($pNumber) || empty($pwd) || empty($repwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function createUser($conn, $name, $email, $pNumber, $pwd)
{
    $sql = "INSERT INTO user (userName, userEmail, userPhone, userPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user/main/register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $pNumber, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../user/main/register.php?error=none");
    exit();
}

// Done
function emptyInputLogin($name, $pwd)
{
    if (empty($name)  || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function loginUser($conn, $name, $pwd)
{
    $uNameExists = uNameExists($conn, $name, $name);

    if ($uNameExists === false) {
        header("location: ../user/main/login.php?error=invalidlogin");
        exit();
    }

    $pwdHashed = $uNameExists["userPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../user/main/login.php?error=wrongpassword");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userId"] = $uNameExists["userId"];
        $_SESSION["userName"] = $uNameExists["userName"];
        header("location: ../user/main/dashboard.php");
        exit();
    }
}

//Done
function loginAdmin($conn, $name, $pwd)
{
    $adminnameExists = adminuNameExists($conn, $name, $name);

    if ($adminnameExists === false) {
        header("location: ../admin/main/login.php?error=invalidlogin");
        exit();
    }

    $pwdHashed = $adminnameExists["adminPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../admin/main/login.php?error=wrongpassword");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["adminId"] = $adminnameExists["adminId"];
        $_SESSION["adminName"] = $adminnameExists["adminName"];
        header("location:../admin/main/dashboard.php");
        exit();
    }
}

// Done
function emptyInputSupport($title, $des)
{
    if (empty($title)  || empty($des)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Done
function submitIssue($conn, $userId, $title, $description, $status)
{
    $sql = "INSERT INTO issue (userId ,title, description, status) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user/issues/addIssue.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssi", $userId, $title, $description, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../user/issues/addIssue.php?error=none");
    exit();
}

function addUser($conn, $name, $email, $phone, $pwd)
{
    $sql = "INSERT INTO users (usersName, usersEmail, usersPhone, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/panel/adduser.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin/panel/adduser.php?error=none");
    exit();
}

// Done
function updateGet($conn)
{
    if (isset($_GET['userId']) && is_numeric($_GET['userId'])) {
        $userId = $_GET['userId'];
        $sql = "SELECT userId, userName, userEmail, userPhone FROM user WHERE userId='$userId';";
        $get_userId = mysqli_query($conn, $sql);

        if (mysqli_num_rows($get_userId) == 1) {
            $row = mysqli_fetch_assoc($get_userId);
            return ($row);
        }
    }
}

function emptyInputUpdate($name, $email, $phone)
{
    if (empty($name) || empty($email) || empty($phone)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// NOT WORKING ******************************************************************************************************************************************************
function updateUserData($conn, $userId, $userName, $userEmail, $userPhone)
{
    // $sql = "UPDATE user SET userName='$userName', userEmail='$userEmail', userPhone='$userPhone' WHERE userId='$userId';";
    $sql = "UPDATE user set userName='" . $_POST['userName'] . "', userEmail='" . $_POST['userEmail'] . "', userPhone='" . $_POST['userPhone'] . "' WHERE userId='" . $_POST['userId'] . "'";

    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location: ../admin/users/viewUser.php?error=none");
        exit();
    } else {
        header("location: ../admin/users/viewUser.php?error=cantupdate");
        exit();
    }
}

// Done
function deleteUser($conn)
{
    if (isset($_GET['userId']) && is_numeric($_GET['userId'])) {

        $usersId = $_GET['userId'];
        $sql = "DELETE FROM user WHERE userId='$usersId';";
        $delete_user = mysqli_query($conn, $sql);

        if ($delete_user) {
            header("location: viewuser.php?error=deleted");
            exit();
        } else {
            header("location: viewuser.php?error=cantdelete");
            exit();
        }
    }
}

// Done
function issueGet($conn)
{
    if (isset($_GET['issueId']) && is_numeric($_GET['issueId'])) {
        $issueId = $_GET['issueId'];
        $sql = "SELECT issue.userId, userName, issueId, title, description, IF(status, 'Solved', 'Pending') status FROM issue, user WHERE issue.userId = user.userId AND issueId='$issueId';";
        $get_issueId = mysqli_query($conn, $sql);

        if (mysqli_num_rows($get_issueId) == 1) {
            $row = mysqli_fetch_assoc($get_issueId);
            return ($row);
        }
    }
}

// NOT WORKING ******************************************************************************************************************************************************
function updateIssueData($conn, $issueId, $status)
{
    $sql = "UPDATE issue SET status=" . $status . " WHERE issueId='$issueId';";
    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location: ../admin/issues/viewIssue.php?error=none");
        exit();
    } else {
        header("location: ../admin/issues/viewIssue.php?error=cantupdate");
        exit();
    }
}

// Done
function yourIssues($conn, $userId)
{
    $sql = "SELECT issueId, title, description, status FROM issue WHERE userId='$userId' ORDER BY issueId DESC;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        header("location: ../user/issues/viewIssue.php");
        exit();
    }
}

function updateUserDataProfile($conn, $usersId, $name, $email, $phone,  $pwd)
{
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET usersName='$name', usersEmail='$email', usersPhone='$phone', usersPwd='$hashedPwd' WHERE usersId='$usersId';";
    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location:../profile/profile.php?error=none");
        exit();
    } else {
        header("location:../profile/profile.php?error=cantupdate");
        exit();
    }
}

function deleteAccount($conn)
{
    if (isset($_GET['usersId']) && is_numeric($_GET['usersId'])) {
        $usersId = $_GET['usersId'];
        $sql = "DELETE FROM users WHERE usersId='$usersId';";
        $delete_user = mysqli_query($conn, $sql);

        if ($delete_user) {
            session_start();
            session_unset();
            session_destroy();
            header("location:../login/login.php?error=deleted");
            exit();
        } else {
            header("location:../profile/profile.php?error=cantdelete");
            exit();
        }
    }
}

// Done
function deleteIssueUser($conn)
{
    if (isset($_GET['issueId']) && is_numeric($_GET['issueId'])) {
        $issueId = $_GET['issueId'];
        $sql = "DELETE FROM issue WHERE issueId='$issueId';";

        $delete_issue = mysqli_query($conn, $sql);

        if ($delete_issue) {
            header("location: ../issues/viewIssue.php?error=deleted");
            exit();
        } else {
            header("location: ../issues/viewIssue.php?error=cantdelete");
            exit();
        }
    }
}
