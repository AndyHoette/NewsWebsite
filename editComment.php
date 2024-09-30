<?php
session_start();

if (!isset($_POST['token']) || !hash_equals($_POST['token'], $_SESSION['token'])) { //makes sure this isn't a CSRF
    header("Location: unauthorized.php");  //deny it
}

require "database.php";

$newComment = htmlentities($_POST['newBody']); // uses FIEO principles
$userNameAttempt = htmlentities($_SESSION['userName']); // same as line above
$commentIDAttempt = htmlentities($_POST['commentID']);

// Fetch the comment to check the username
$stmt = $mysqli->prepare("SELECT userWhoCreated FROM Comments WHERE commentID = ?");
$stmt->bind_param("i", $commentIDAttempt);
$stmt->execute();
$stmt->bind_result($userWhoCreated);
$stmt->fetch();
$stmt->close();

if ($userWhoCreated == $userNameAttempt) {
    // Update the comment
    $stmt = $mysqli->prepare("UPDATE Comments SET body = ? WHERE commentID = ?");
    $stmt->bind_param("si", $newComment, $commentIDAttempt);
    $stmt->execute();
    $stmt->close();
} else {
    header("Location: unauthorized.php");
    exit;
}

header("Location: storypage.php?storyID=" . htmlentities($_POST['storyID']));
?>