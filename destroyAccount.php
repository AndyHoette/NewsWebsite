<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
if(!isset($_POST['token'])||!hash_equals($_POST['token'],$_SESSION['token'])){ //makes sure this isn't a CSRF
    header("Location: unauthorized.php");
}
require "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Destroying Account</title>
</head>
<body>
<?php
    //to delete the user we have to first make sure that the data entries of other tables with foreign keys to the user
    //are deleted

    //first we will delete all the comments the user made
    $stmt  = $mysqli->prepare("DELETE FROM Comments WHERE userWhoCreated = ?");
    $stmt->bind_param("s", $_SESSION['userName']);
    $stmt->execute(); //deletes deletedUser comments
    $stmt->close();

    //next we would want to delete all the stories the user made but first we need to delete all the comments
    //on the aforementioned stories
    //need to have a statement where we get all comments whose story on is linked to the user
    $stmt = $mysqli->prepare("DELETE Comments FROM Comments
    JOIN Stories ON Comments.storyCommentIsON = Stories.storyID
    WHERE Stories.userCreated = ?");
    $stmt->bind_param("s", $_SESSION['userName']);
    $stmt->execute();
    $stmt->close();
    //now we can delete the stories the user made without errors
    $stmt = $mysqli->prepare("DELETE FROM Stories WHERE userCreated = ?");
    $stmt->bind_param("s", $_SESSION['userName']);
    $stmt->execute();
    $stmt->close();
    //now we can finally delete the user
    $stmt = $mysqli->prepare("DELETE FROM Users WHERE userName = ?");
    $stmt->bind_param("s", $_SESSION['userName']);
    $stmt->execute();
    $stmt->close();
    session_unset();
    session_destroy();
    header("Location: home.php"); //destroys your sessions and send you to the home page
?>
</body>
</html>
