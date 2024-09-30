<?php
require "database.php";
session_start();


if (isset($_SESSION['userName'])) { //if we have userName then we should be allowed to continue otherwise reject this web page
    echo "<p>Hello " . $_SESSION['userName'] . "</p>"; //greets the user
    echo "<a href='logout.php'>Log Out</a><br>"; //gives them the option to log out
    echo "<a href='home.php'>Back to Home</a>";
} else {
    header("Location: login.php");
}

require "database.php"; //establishes the user

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $mysqli->real_escape_string($_POST['title']);
    $body = $mysqli->real_escape_string($_POST['body']);
    $link = $mysqli->real_escape_string($_POST['link']);


    $sql = "INSERT INTO Stories (title, body, link, userCreated) VALUES ('$title', '$body', '$link', '$_SESSION[userName]')";

    if ($mysqli->query($sql) === TRUE) {
        echo "New story created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create a New Story</title>
</head>

<body>
    <h1>Create a New Story</h1>
    <form action="createStory.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="body">Body:</label>
        <textarea id="body" name="body"></textarea><br><br> <!--Creates a simple form with a CSRF token-->

        <label for="link">Link:</label>
        <input type="url" id="link" name="link"><br><br>

        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

        <input type="submit" value="Submit">
    </form>
</body>

</html>