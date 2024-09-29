<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
</head>

<body>
    <?php /** @noinspection SqlNoDataSourceInspection */
    session_start();
    $mysqli = new mysqli('localhost', 'viewer', 'easyPassword', 'newsWebsite');

    if ($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
    }
    //have a login button/sign out button
//should list every story
    if (isset($_SESSION['userName'])) {
        echo "<p>Hello " . $_SESSION['userName'] . "</p>";
        echo "<a href='logout.php'>Log Out</a>";
        echo "<a href='userProfile.php'>See Profile</a>";
        echo "<a href='createStory.php'>Create New Story</a>";
    } else {
        echo "<a href='login.php'>Log In</a>";
    }






    echo "<ul>";
    $stmt = $mysqli->prepare("select title, userCreated, storyID from Stories");
    $stmt->execute();
    $stmt->bind_result($title, $author, $storyID);
    while ($stmt->fetch()) {
        printf("<li><a href='storypage.php?storyID=$storyID'>%s by %s</a>\n</li>", $title, $author);
    }
    echo "</ul>\n";
    ?>
</body>

</html>