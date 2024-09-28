<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Processing Account Creation</title>
</head>
<body>
<?php
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
$userNameAttempt = $_POST["user"];
$passwordAttempt = $_POST["password"];
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $userNameAttempt);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt);
$stmt->fetch();

// Compare the submitted password to the actual password hash

if($cnt == 0){
    // Username available
    //create a new user with a userName userNameAttempt, password PasswordAttempt (hashed) and no bio
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
