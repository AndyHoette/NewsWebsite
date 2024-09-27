<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Processing Log In</title>
</head>
<body>
<?php
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');
$userNameAttempt = $_POST["user"];
$passwordAttempt = $_POST["password"];
$stmt = $mysqli->prepare("SELECT COUNT(*), password FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $userNameAttempt);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $pwd_hash);
$stmt->fetch();

// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($passwordAttempt, $pwd_hash)){
    // Login succeeded!
    $_SESSION['username'] = $userNameAttempt;
    header('Location: home.php');
    // Redirect to your target page
}
session_destroy();
header("Location:login.php"); //go back to log in
exit;
?>
</body>
</html>
