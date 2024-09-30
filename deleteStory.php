<?php
//first check CSRF token is correct
//then check if userName and userCreated are the same
//then delete all the comments associated with the story
//then delete the story
session_start();
if(!isset($_POST['token'])||!hash_equals($_POST['token'],$_SESSION['token'])){ //makes sure this isn't a CSRF
    header("Location: unauthorized.php");
}
require "database.php";
$stmt = $mysqli->prepare("delete from Stories where id=?");
$stmt->bind_param("i",$_POST['storyID']);
$stmt->execute();
$stmt->close();
header("Location: userProfile.php");
exit;