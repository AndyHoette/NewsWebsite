<?php /** @noinspection SqlNoDataSourceInspection */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Processing Account Creation</title>
</head>
<body>
<?php
//session_start();
//if(!(isset($_POST['token'])&&hash_equals($_POST['token'],$_SESSION['token']))){
//    header("Location: unauthorized.php");
//}
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
$userNameAttempt = $_POST["user"];
$passwordAttempt = $_POST["password"];
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE userName=?");

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
    // Redirect to your target page
}
header("Location:login.php"); //go back to log in
exit;
?>
</body>
</html>
