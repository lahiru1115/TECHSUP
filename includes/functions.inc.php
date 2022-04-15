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

// Admin & User register invalid username check (Must be A-Z, a-z, 0-9) 
function invaliduName($name)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin & User register invalid password check (Must be at least 4 characters) 
function invalidPwd($pwd)
{
    if (strlen($pwd) >= 4) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin & User invalid email check
function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Admin & User register password and re-enter password check
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
function adminuNameEmailExists($conn, $name)
{
    $sql = "SELECT * FROM admin WHERE adminName = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin/main/register.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
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
    if (empty($name) || empty($pwd)) {
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
        header("location: ../admin/issues/viewIssue.php?error=notWorking");
        exit();
    }
}

// Admin get user details
function adminGetUserData($conn)
{
    $sql = "SELECT userId, userName, userEmail, userPhone FROM user";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        header("location: ../admin/users/viewUser.php?error=notWorking");
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

// User existing username or email check
function useruNameEmailExists($conn, $name, $email)
{
    $sql = "SELECT * FROM user WHERE userName = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user/main/register.php?error=stmtFailed");
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

// User register empty input check
function userRegisterEmptyInput($name, $email, $phone, $pwd, $repwd)
{
    if (empty($name) || empty($email) || empty($phone) || empty($pwd) || empty($repwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Create new user account
function userRegister($conn, $name, $email, $phone, $pwd)
{
    $sql = "INSERT INTO user (userName, userEmail, userPhone, userPwd) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user/main/register.php?error=stmtFailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../user/main/register.php?error=none");
    exit();
}

// User login empty input check
function userLoginEmptyInput($name, $pwd)
{
    if (empty($name)  || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// User login validation
function userLogin($conn, $name, $pwd)
{
    $uNameExists = useruNameEmailExists($conn, $name, $name);

    if ($uNameExists === false) {
        header("location: ../user/main/login.php?error=invalidLogin");
        exit();
    }

    $pwdHashed = $uNameExists["userPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../user/main/login.php?error=invalidLogin");
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
    $adminnameExists = adminuNameEmailExists($conn, $name);

    if ($adminnameExists === false) {
        header("location: ../admin/main/login.php?error=invalidLogin");
        exit();
    }

    $pwdHashed = $adminnameExists["adminPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../admin/main/login.php?error=invalidLogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["adminId"] = $adminnameExists["adminId"];
        $_SESSION["adminName"] = $adminnameExists["adminName"];
        header("location:../admin/main/dashboard.php");
        exit();
    }
}

// User add issue empty input check
function userAddIssueEmptyInput($title, $des)
{
    if (empty($title)  || empty($des)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// User add new issue
function addIssue($conn, $userId, $title, $description, $status)
{
    $sql = "INSERT INTO issue (userId ,title, description, status, timestamp) VALUES (?, ?, ?, ?, now());";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user/issues/addIssue.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssi", $userId, $title, $description, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../user/issues/addIssue.php?error=none");
    exit();
}

// Admin & User get user details for update
function getUserDataUpdate($conn)
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
            header("location: viewuser.php?error=cantDelete");
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
    // $sql = "UPDATE issue SET status=" . $status . " WHERE issueId='$issueId';";
    $sql = "UPDATE issue SET status=$status WHERE issueId='$issueId';";
    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location: ../admin/issues/viewIssue.php?error=none");
        exit();
    } else {
        header("location: ../admin/issues/viewIssue.php?error=cantUpdate");
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

// User get pending issue details
function userPendingIssues($conn, $userId)
{
    $sql = "SELECT issueId, title, description, timestamp, IF(status, 'Solved', 'Pending') status FROM issue WHERE userId='$userId' AND status=false ORDER BY timestamp DESC LIMIT 10;";
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

// User get solved issue details of all users
function userSolvedIssues($conn, $userId)
{
    $sql = "SELECT issueId, title, description, timestamp, IF(status, 'Solved', 'Pending') status FROM issue WHERE userId='$userId' AND status=true ORDER BY timestamp DESC LIMIT 10;";
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

// User update profile (Only password)
function userUpdateProfile($conn, $userId, $pwd)
{
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET userPwd='$hashedPwd' WHERE userId='$userId';";
    $update_query = mysqli_query($conn, $sql);

    if ($update_query) {
        header("location: ../user/profile/updateUser.php?error=none");
        exit();
    } else {
        header("location: ../user/profile/updateUser.php?error=cantUpdate");
        exit();
    }
}

// User delete profile
function userDeleteProfile($conn)
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
            header("location: updateUser.php?error=cantDelete");
            exit();
        }
    }
}

// User delete issue
function userDeleteIssue($conn)
{
    if (isset($_GET['issueId']) && is_numeric($_GET['issueId'])) {
        $issueId = $_GET['issueId'];
        $sql = "DELETE FROM issue WHERE issueId='$issueId';";

        $delete_issue = mysqli_query($conn, $sql);

        if ($delete_issue) {
            header("location: ../issues/viewIssue.php?error=deleted");
            exit();
        } else {
            header("location: ../issues/viewIssue.php?error=cantDelete");
            exit();
        }
    }
}
