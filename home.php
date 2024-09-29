<?php
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
//have a login button/sign out button
//should list every story
if(session_id() == '') {
    echo "<a href='login.php'>Log In</a>>";
}
else{
    echo "<a href='logout.php'>Log Out</a>>";
}
$stmt = $mysqli->prepare("select title, userCreated from Stories");
$stmt->execute();
$stmt->bind_result($title, $author);
while($stmt -> fetch()) {
    printf("%s by %s\n", $title, $author);
}
?>

