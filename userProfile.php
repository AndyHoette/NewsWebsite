<?php /** @noinspection SqlNoDataSourceInspection */
session_start();
require "database.php"; //establishes a connection to the database
if(isset($_SESSION['userName'])) { //if we have a username great it and show off how many stories they have made
    echo "<p>Hello " . $_SESSION['userName'] . "</p>";
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE userName = ?");
    $stmt->bind_param("s", $_SESSION['userName']);
    $stmt->execute();
    $stmt->bind_result($storyCount);
    $stmt->fetch();
    $stmt->close();
    echo "<p>You Have made " . $storyCount . " stories.</p>";
    echo "<a href='logout.php'>Log Out \n</a>";
}
else{ //this else should never be accessible
    echo "<p>uh oh</p>";
    exit;
    //header("Location: home.php");
}
echo "<a href='home.php'>Back to Home \n</a>";

$stmt = $mysqli->prepare("Select userName, bio from Users where userName = ?");
$stmt->bind_param("s", $_SESSION['userName']);
$stmt->execute();
$stmt->bind_result($userName, $bio); //queries the database for this users bio
$stmt->fetch();
$stmt->close();
if($bio != ''){
    echo "<p>\n Bio: " . $bio . "\n</p>"; //if they have a bio print it out
}
else {
    require ("createBioForm.php"); //if they don't have a bio then we should give the form to make one
}
?>
<form name="destroyAccount" action="destroyAccount.php" method="post" autocomplete="off">
    <p>
        <input type="text" name="token" value="<?php echo $_SESSION['token']; ?>" /> <!--this button is just a button with a CSRF token-->
        <input type="submit" value="Destroy Account" />
    </p>
</form>
<?php
echo "<h3>Stories you Created</h3>";
echo "<ul>"; //creates a list of stories similar to the home page but it only shows the users Stories.
$stmt = $mysqli->prepare("select title, userCreated, storyID from Stories where userCreated = ?");
$stmt->bind_param("s", $_SESSION['userName']);
$stmt->execute();
$stmt->bind_result($title, $author, $storyID);
while ($stmt->fetch()) {
    printf("<li><a href='storypage.php?storyID=$storyID'>%s by %s</a>\n</li>", $title, $author);
}
echo "</ul>\n";
?>

