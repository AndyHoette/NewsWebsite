<?php /** @noinspection SqlNoDataSourceInspection */
require "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Processing Log In</title>
</head>
<body>
<?php
session_start();
$userNameAttempt = $_POST["user"];
$passwordAttempt = $_POST["password"];
$stmt = $mysqli->prepare("SELECT COUNT(*), password FROM Users WHERE userName=?"); //sees how many users have this userName

// Bind the parameter
$stmt->bind_param('s', $userNameAttempt);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $pwd_hash);
$stmt->fetch();

// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($passwordAttempt, $pwd_hash)){
    //we dont want this userName to appear less than 1 (then it doesn't exist)
    //and we dont want this userName to appear more than 1 (this would be a violation and should never be possible
    // Login succeeded!
    $_SESSION['userName'] = $userNameAttempt; //we want to store the userName in a session variable
    header('Location: home.php');
    // Redirect to your target page
    exit;
}
header("Location:loginFail.php"); //go back to log in
exit;
?>
</body>
</html>
