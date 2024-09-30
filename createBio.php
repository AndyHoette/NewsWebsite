<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
if(!isset($_POST['token'])||!hash_equals($_POST['token'],$_SESSION['token'])){ //makes sure this isn't a CSRF
    header("Location: unauthorized.php");  //deny it
}
require "database.php"; //sets up our mysql connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creating Bio</title>
</head>
<body>
<?php
$newBio = htmlentities($_POST['bio']); //uses FIEO principles
$userNameAttempt = htmlentities($_SESSION['userName']); //same as line above
$stmt = $mysqli->prepare("update Users set bio = ? where userName = ?"); //updates the user's bio in the appropriate spot
$stmt->bind_param("ss", $newBio, $userNameAttempt);
$stmt->execute();
$stmt->close();
header("Location: userProfile.php");
exit;
?>
</body>