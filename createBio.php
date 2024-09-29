<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
if(!isset($_POST['token'])||$_POST['token']!=$_SESSION['token']){
    header("Location: unauthorized.php");
}
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creating Bio</title>
</head>
<body>
<?php
$newBio = htmlentities($_POST['newBio']);
$userNameAttempt = htmlentities($_POST['userName']);
$stmt = $mysqli->prepare("update Users set bio = ? where userName = ?");
$stmt->bind_param("ss", $newBio, $userNameAttempt);
$stmt->execute();
$stmt->close();
?>
</body>