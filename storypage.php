<?php
require "database.php";

$story_id = $_GET['storyID'];
$comment_id = $_GET['commentID'];

$stmtStory = $mysqli->prepare("SELECT title, body, link FROM Stories WHERE storyID = ?");

// Bind Parameters
$stmtStory->bind_param("i", $story_id);
$stmtStory->execute();
$story_result = $stmtStory->get_result();
$story = $story_result->fetch_assoc();

$stmtComment = $mysqli->prepare("SELECT body FROM Comments WHERE commentID = ?");
$stmt_comment->bind_param("i", $comment_id);
$stmt_comment->execute();
$comment_result = $stmt_comment->get_result();
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