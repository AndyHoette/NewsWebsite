<?php /** @noinspection SqlNoDataSourceInspection */
//session_start();
//echo isset($_POST['token']);
//echo "\n";
//echo $_POST['token'];
//echo "\n";
//echo $_SESSION['token'];
//exit;
//if(!isset($_POST['token'])||$_POST['token']!=$_SESSION['token']){
//    header("Location: unauthorized.php");
//}
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Processing Log In</title>
</head>
<body>
<?php
$userNameAttempt = $_POST["user"];
$passwordAttempt = $_POST["password"];
$stmt = $mysqli->prepare("SELECT COUNT(*), password FROM Users WHERE userName=?");

// Bind the parameter
$stmt->bind_param('s', $userNameAttempt);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $pwd_hash);
$stmt->fetch();

// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($passwordAttempt, $pwd_hash)){
    // Login succeeded!
    session_start();
    $_SESSION['userName'] = $userNameAttempt;
    header('Location: home.php');
    // Redirect to your target page
    exit;
}
header("Location:loginFail.php"); //go back to log in
exit;
?>
</body>
</html>
