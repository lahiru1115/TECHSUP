<?php

// Admin register empty input check
function adminRegisterEmptyInput($name, $email, $pwd, $repwd)
{
    if (empty($name) || empty($email) || empty($pwd) || empty($repwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin register invalid username check (Must be A-Z, a-z, 0-9) 
function invaliduName($name)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin register invalid password check (Must be at least 4 characters) 
function invalidPwd($pwd)
{
    if (strlen($pwd) >= 4) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin invalid email check
function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin register password and re-enter password check
function pwdMatch($pwd, $repwd)
{
    if ($pwd !== $repwd) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin existing username or email check
function adminuNameEmailExists($conn, $name, $email)
{
    $sql = "SELECT * FROM admin WHERE adminName = ? OR adminEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/main/register.php?error=stmtFailed");
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

// Create new admin account
function adminRegister($conn, $name, $email, $pwd)
{
    $sql = "INSERT INTO admin (adminName, adminEmail, adminPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/main/register.php?error=stmtFailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin/main/register.php?error=none");
    exit();
}

// Admin login empty input check
function adminLoginEmptyInput($name, $pwd)
{
    if (empty($name)  || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin get issue details of all users
function adminGetIssueDataView($conn)
{
    $sql = "SELECT user.*, issue.*, IF(status, 'Solved', 'Pending') status FROM issue, user WHERE issue.userId = user.userId ORDER BY timestamp DESC;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        header("location: ../admin/main/viewIssue.php?error=notWorking");
        exit();
    }
}

// Admin get user details
function adminGetUserData($conn)
{
    $sql = "SELECT user.userId, userName, userEmail, userPhone, COUNT(issueId) FROM user, issue WHERE user.userId = issue.userId GROUP BY issue.userId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        header("location: ../admin/users/viewUser.php?error=notworking");
        exit();
    }
}

// Admin delete issue
function adminDeleteIssue($conn)
{
    if (isset($_GET['issueId']) && is_numeric($_GET['issueId'])) {
        $issuesId = $_GET['issueId'];
        $sql = "DELETE FROM issue WHERE issueId='$issuesId';";

        $delete_issue = mysqli_query($conn, $sql);

        if ($delete_issue) {
            header("location: viewIssue.php?error=deleted");
            exit();
        } else {
            header("location: viewIssue.php?error=cantDelete");
            exit();
        }
    }
}

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

function emptyInputSignup($name, $email, $pNumber, $pwd, $repwd)
{
    if (empty($name) || empty($email) || empty($pNumber) || empty($pwd) || empty($repwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function createUser($conn, $name, $email, $pNumber, $pwd)
{
    $sql = "INSERT INTO user (userName, userEmail, userPhone, userPwd) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user/main/register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $pNumber, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../user/main/register.php?error=none");
    exit();
}

function emptyInputLogin($name, $pwd)
{
    if (empty($name)  || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

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

// Admin login validation
function adminLogin($conn, $name, $pwd)
{
    $adminnameExists = adminuNameEmailExists($conn, $name, $name);

    if ($adminnameExists === false) {
        header("location: ../admin/main/login.php?error=invalidLogin");
        exit();
    }

    $pwdHashed = $adminnameExists["adminPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../admin/main/login.php?error=wrongPassword");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["adminId"] = $adminnameExists["adminId"];
        $_SESSION["adminName"] = $adminnameExists["adminName"];
        header("location:../admin/main/dashboard.php");
        exit();
    }
}

function emptyInputSupport($title, $des)
{
    if (empty($title)  || empty($des)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function submitIssue($conn, $userId, $title, $description, $status)
{
    $sql = "INSERT INTO issue (userId ,title, description, status, timestamp) VALUES (?, ?, ?, ?, now());";
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

// Admin get user details for update
function adminGetUserDataUpdate($conn)
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

// Admin update user empty input check
function adminUpdateUserEmptyInput($name, $email, $phone)
{
    if (empty($name) || empty($email) || empty($phone)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Update user details (userName, userEmail, userPhone)
function updateUserData($conn, $userId, $userName, $userEmail, $userPhone)
{
    $sql = "UPDATE user SET userName='$userName', userEmail='$userEmail', userPhone='$userPhone' WHERE userId='$userId';";

    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location: ../admin/users/viewUser.php?error=none");
        exit();
    } else {
        header("location: ../admin/users/viewUser.php?error=cantUpdate");
        exit();
    }
}

// Admin delete user account
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

// Admin get issue details for update
function adminGetIssueDataUpdate($conn)
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

// Admin get issue details for view
function adminGetIssueDataAll($conn)
{
    if (isset($_GET['issueId']) && is_numeric($_GET['issueId'])) {
        $issueId = $_GET['issueId'];
        $sql = "SELECT issueId, title, description, timestamp, issue.userId, userName, userEmail, userPhone, IF(status, 'Solved', 'Pending') status FROM issue, user WHERE issue.userId = user.userId AND issueId='$issueId';";
        $get_issueId = mysqli_query($conn, $sql);

        if (mysqli_num_rows($get_issueId) == 1) {
            $row = mysqli_fetch_assoc($get_issueId);
            return ($row);
        }
    }
}

// Admin update issue (status)
function adminUpdateIssue($conn, $issueId, $status)
{
    $sql = "UPDATE issue SET status=" . $status . " WHERE issueId='$issueId';";
    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location: ../admin/issues/viewIssue.php?error=none");
        exit();
    } else {
        header("location: ../admin/issues/viewIssue.php?error=cantUpdate");
        exit();
    }
}

function yourIssues($conn, $userId)
{
    $sql = "SELECT issueId, title, description, timestamp, IF(status, 'Solved', 'Pending') status FROM issue WHERE userId='$userId' ORDER BY timestamp DESC;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
        exit();
    } else {
        // header("location: ../user/issues/viewIssue.php?error=notworking");
        echo "<p class=\"success2\">There are no issues available!</p>";
        exit();
    }
}

function userPendingIssues($conn, $userId)
{
    $sql = "SELECT issueId, title, description, timestamp, IF(status, 'Solved', 'Pending') status FROM issue WHERE userId='$userId' AND status=false ORDER BY timestamp DESC LIMIT 5;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
        exit();
    } else {
        // header("location: ../user/issues/viewIssue.php?error=notworking");
        echo "<p class=\"success2\">There are no issues available!</p>";
        exit();
    }
}

// Admin get pending issue details of all users
function adminPendingIssues($conn)
{
    $sql = "SELECT issueId, userName, title, description, timestamp, IF(status, 'Solved', 'Pending') status FROM issue, user WHERE issue.userId = user.userId AND status=false ORDER BY timestamp DESC LIMIT 10;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
        exit();
    } else {
        // header("location: ../user/issues/viewIssue.php?error=notworking");
        echo "<p class=\"success2\">There are no issues available!</p>";
        exit();
    }
}

// Admin get solved issue details of all users
function adminSolvedIssues($conn)
{
    $sql = "SELECT issueId, userName, title, description, timestamp, IF(status, 'Solved', 'Pending') status FROM issue, user WHERE issue.userId = user.userId AND status=true ORDER BY timestamp DESC LIMIT 10;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
        exit();
    } else {
        // header("location: ../user/issues/viewIssue.php?error=notworking");
        echo "<p class=\"success2\">There are no issues available!</p>";
        exit();
    }
}

// Admin get most issues by users
function adminMostIssues($conn)
{
    $sql = "SELECT user.userId, userName, userEmail, userPhone, COUNT(issueId) FROM user, issue WHERE user.userId = issue.userId GROUP BY issue.userId ORDER BY COUNT(issueId) DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
        exit();
    } else {
        // header("location: ../user/issues/viewIssue.php?error=notworking");
        echo "<p class=\"success2\">There are no users available!</p>";
        exit();
    }
}

function updateUserDataProfile($conn, $userId, $userName, $userEmail, $userPhone, $pwd)
{
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET userName='$userName', userEmail='$userEmail', userPhone='$userPhone', userPwd='$hashedPwd' WHERE userId='$userId';";
    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location: ../user/profile/updateUser.php?error=none");
        exit();
    } else {
        header("location: ../user/profile/updateUser.php?error=cantupdate");
        exit();
    }
}

function deleteAccount($conn)
{
    if (isset($_GET['userId']) && is_numeric($_GET['userId'])) {
        $userId = $_GET['userId'];
        $sql = "DELETE FROM user WHERE userId='$userId';";
        $delete_user = mysqli_query($conn, $sql);

        if ($delete_user) {
            session_start();
            session_unset();
            session_destroy();
            header("location: ../main/login.php?error=deleted");
            exit();
        } else {
            header("location: updateUser.php?error=cantdelete");
            exit();
        }
    }
}

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
