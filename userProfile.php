<?php
session_start();
if(isset($_SESSION['userName'])) {
    echo "<p>Hello " . $_SESSION['userName'] . "</p>";
    echo "<a href='logout.php'>Log Out</a>";
}
else{
    echo "<p>uh oh</p>";
    //header("Location: home.php");
}
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
$stmt = $mysqli->prepare("Select userName, bio from Users where userName = ?");
$stmt->bind_param("s", $_SESSION['userName']);
$stmt->execute();
$stmt->bind_result($userName, $bio);
echo "<h1>" . $userName . "</h1>";
?>