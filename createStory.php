<?php
require "database.php";
session_start();
if (isset($_SESSION['userName'])) {
    echo "<p>Hello " . $_SESSION['userName'] . "</p>";
    echo "<a href='logout.php'>Log Out</a>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $body = $conn->real_escape_string($_POST['body']);
    $link = $conn->real_escape_string($_POST['link']);

    $sql = "INSERT INTO stories (title, body, link) VALUES ('$title', '$body', '$link')";

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
        <textarea id="body" name="body"></textarea><br><br>

        <label for="link">Link:</label>
        <input type="url" id="link" name="link"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>