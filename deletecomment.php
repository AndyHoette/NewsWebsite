<?php
session_start();

if (!isset($_POST['token']) || !hash_equals($_POST['token'], $_SESSION['token'])) { //makes sure this isn't a CSRF
    header("Location: unauthorized.php");  //deny it
}

require "database.php";

$userNameAttempt = htmlentities($_SESSION['userName']); // same as line above
$commentIDAttempt = htmlentities($_POST['commentID']);

// Fetch comment/check username
$stmt = $mysqli->prepare("SELECT userWhoCreated FROM Comments WHERE commentID = ?");
$stmt->bind_param("i", $commentIDAttempt);
$stmt->execute();
$stmt->bind_result($userWhoCreated);
$stmt->fetch();
$stmt->close();

if ($userWhoCreated == $userNameAttempt) {
    // Delete the comment
    $stmt = $mysqli->prepare("DELETE FROM Comments WHERE commentID = ?");
    $stmt->bind_param("i", $commentIDAttempt);
    $stmt->execute();
    $stmt->close();
} else {
    die("You are not authorized to edit this comment.");
}

header("Location: storypage.php?storyID=" . htmlentities($_POST['storyID']));
?>