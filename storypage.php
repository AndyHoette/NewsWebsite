<?php
require "database.php";

$story_id = $_GET['storyID'];

$stmtStory = $mysqli->prepare("SELECT title, body, link FROM Stories WHERE storyID = ?");

// Bind Parameters
$stmtStory->bind_param("i", $story_id);
$stmtStory->execute();
$story_result = $stmtStory->get_result();
$story = $story_result->fetch_assoc();

$stmtComment = $mysqli->prepare("SELECT body, link FROM Comments WHERE storyCommentIsOn = ?");
$stmtComment->bind_param("i", $story_id);
$stmtComment->execute();
$comment_result = $stmtComment->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Story</title>
</head>

<body>
    <h1><?php echo $story['title']; ?></h1>
    <p><?php echo $story['body']; ?></p>
    <h2>Comments</h2>
    <ul>
        <?php
        if ($comment_result->num_rows > 0) {
            while ($row = $comment_result->fetch_assoc()) {
                echo "<li>" . $row["body"] . "</li>";
                echo "<li>" . $row["link"] . "</li>";
            }
        } else {
            echo "No comments yet.";
        }
        $mysqli->close();
        ?>
    </ul>

</body>

</html>