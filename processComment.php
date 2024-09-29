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
    <title>Adding Comment</title>
</head>
<body>
<?php
$newComment = htmlentities($_POST['body']); //uses FIEO principles
$userNameAttempt = htmlentities($_SESSION['userName']); //same as line above
$storyIDAttempt = htmlentities($_POST['storyID']);
$stmt = $mysqli->prepare("INSERT INTO Comments (body, userWhoCreated, storyCommentIsOn) values (?, ?, ?)");
$stmt->bind_param("ssi", $newComment, $userNameAttempt, $storyIDAttempt);
//adds a new entry into Comments based on the data
$stmt->execute();
$stmt->close();
header("Location: storypage.php".$storyIDAttempt);
?>
</body>