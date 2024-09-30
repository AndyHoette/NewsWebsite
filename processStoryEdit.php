<?php
session_start();
if(!isset($_POST['token'])||!hash_equals($_POST['token'],$_SESSION['token'])){ //makes sure this isn't a CSRF
    header("Location: unauthorized.php");
}
require "database.php";
$newTitle = $_POST['title'];
$newStory = $_POST['story'];
$newLink = $_POST['link'];
$stmt = $mysqli->prepare("update Stories set title=?, story=?, link=? where id=?");
$stmt->bind_param("sssi", $newTitle, $newStory, $newLink, $_POST['storyID']);
$stmt->execute();
$stmt->close();
header("Location: userProfile.php");
exit;