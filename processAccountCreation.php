<?php /** @noinspection SqlNoDataSourceInspection */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Processing Account Creation</title>
</head>
<body>
<?php
session_start();
if(!isset($_POST['token'])||!hash_equals($_POST['token'],$_SESSION['token'])){ //makes sure this isn't a CSRF
    header("Location: unauthorized.php");
}
require "database.php";
$userNameAttempt = htmlentities($_POST["user"]);
$passwordAttempt = htmlentities($_POST["password"]);
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE userName=?"); //sees how many users already have this username

// Bind the parameter
$stmt->bind_param('s', $userNameAttempt);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt);
$stmt->fetch();
$stmt->close();

// Compare the submitted password to the actual password hash

if($cnt == 0){
    // Username available
    //create a new user with a userName userNameAttempt, password PasswordAttempt (hashed) and no bio
    session_start();
    $_SESSION['username'] = $userNameAttempt;
    $passwordAttempt = password_hash($passwordAttempt, PASSWORD_BCRYPT);
    $stmt2 = $mysqli->prepare("INSERT INTO Users (userName, password) VALUES (?, ?)");
    $userNameAttempt = htmlentities($userNameAttempt);
    $passwordAttempt = htmlentities($passwordAttempt);
    $stmt2->bind_param('ss', $userNameAttempt, $passwordAttempt);
    $stmt2->execute();
    $_SESSION['userName'] = $userNameAttempt;
    header('Location: home.php');
    exit;
    // Redirect to your home page
}
header("Location:accountCreationFail.php"); //go back to log in
exit;
?>
</body>
</html>
