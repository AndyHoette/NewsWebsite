<?php
require "database.php";

$story_id = $_GET['id'];

$sql_Story = "SELECT title, body, link FROM Stories WHERE id=$story_id";
$story_result = $conn->query($sql_Story);
$story = $result_story->fetch_assoc();


$sql_comment = "SELECT body FROM Comments WHERE storyCommentIsOn=$story_id";
$comment_result = $conn->query($sql_comment);
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
        if ($result_comments->num_rows > 0) {
            while ($row = $result_comments->fetch_assoc()) {
                echo "<li>" . $row["body"] . "</li>";
            }
        } else {
            echo "No comments yet.";
        }
        $conn->close();
        ?>
    </ul>

</body>

</html>