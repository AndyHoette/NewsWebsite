<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
if(isset($_SESSION['userName'])) {
    echo "<p>Hello " . $_SESSION['userName'] . "</p>";
    echo "<a href='logout.php'>Log Out \n</a>";
    echo "<a href='destroyAccount.php'>Delete Account \n</a>";
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
$stmt->close();
if($bio != ''){
    echo "<p>\n Bio: " . $bio . "\n</p>";
}
else {
    require ("createBioForm.php");
}
?>
<form name="destroyAccount" action="destroyAccount.php" method="post" autocomplete="off">
    <p>
        <input type="hidden" name="token" value="<?php echo($_SESSION['token']); ?>" />
        <input type="submit" value="Destroy Account" />
    </p>
</form>
<?php
$mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

if ($mysqli->connect_errno) {
printf("Connection Failed: %s\n", $mysqli->connect_error);
exit;
}
echo "<ul>";
$stmt = $mysqli->prepare("select title, userCreated, storyID from Stories where userCreated = ?");
$stmt->bind_param("s", $_SESSION['userName']);
$stmt->execute();
$stmt->bind_result($title, $author, $storyID);
while ($stmt->fetch()) {
    printf("<li><a href='storypage.php?storyID=$storyID'>%s by %s</a>\n</li>", $title, $author);
}
echo "</ul>\n";
?>
?>

