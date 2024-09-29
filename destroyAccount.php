<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
if(!isset($_POST['token'])||!hash_equals($_POST['token'],$_SESSION['token'])){
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
    <title>Destroying Account</title>
</head>
<body>
<?php
    $stmt  = $mysqli->prepare("DELETE FROM Comments WHERE userWhoCreated = ?");
    $stmt->bind_param("s", $_SESSION['userName']);
    $stmt->execute();
    $stmt->close();

    //need to have a statement where we get all comments whose story on is linked to the user
    //Delete from Comments
    //Join Stories on Comments.storyCommentIsON = Stories.storyID
    //Where Stories.userCreated = $_SESSION['userName']
    $stmt = $mysqli->prepare("DELETE FROM Users WHERE userCreated = ?");
    $stmt->bind_param("s", $_SESSION['userName']);
    $stmt->execute();
    $stmt->close();
    session_unset();
    session_destroy();
    header("Location: home.php");
?>
</body>
</html>
