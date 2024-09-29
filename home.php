<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
</head>

<body>
    <?php /** @noinspection SqlNoDataSourceInspection */
    session_start();
    if(!isset($_SESSION['token'])){
        $_SESSION['token'] = bin2hex(random_bytes(32)); //if we need a token we should generate one
    }
    require "database.php";
    if (isset($_SESSION['userName'])) { //if the user is logged in there should be more such as a greeting, logout, etc.
        echo "<p>Hello " . $_SESSION['userName'] . "</p>";
        echo "<br><a href='logout.php'>Log Out</a>";
        echo "<br><a href='userProfile.php'>See Profile</a>";
        echo "<br><a href='createStory.php'>Create New Story</a><br>";
    } else {
        echo "<a href='login.php'>Log In</a>";
    }






    echo "<ul>";
    $stmt = $mysqli->prepare("select title, userCreated, storyID from Stories");
    $stmt->execute();
    $stmt->bind_result($title, $author, $storyID);
    while ($stmt->fetch()) { //loops through the query results and prints them to the screen
        printf("<li><a href='storypage.php?storyID=$storyID'>%s by %s</a>\n</li>", $title, $author);
        //the stories in text link to a webpage with a get request having which page is supposed to be open
    }
    echo "</ul>\n";
    ?>
</body>

</html>