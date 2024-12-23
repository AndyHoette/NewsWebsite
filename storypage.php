<?php
require "database.php";
session_start();
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32)); //if we need a token we should generate one
}
$story_id = $_GET['storyID']; //story ID was passed as a get request which shouldn't be a problem because anyone should be able to view this site

$stmtStory = $mysqli->prepare("SELECT title, body, link FROM Stories WHERE storyID = ?");

// Bind Parameters
$stmtStory->bind_param("i", $story_id);
$stmtStory->execute();
$story_result = $stmtStory->get_result();
$story = $story_result->fetch_assoc();

$stmtComment = $mysqli->prepare("SELECT body, userWhoCreated, commentID FROM Comments WHERE storyCommentIsOn = ?");
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
    <a href="home.php">Back to Home</a>
    <h1><?php echo $story['title']; ?></h1>
    <p><?php echo $story['body']; ?></p>
    <p><a href="<?php echo $story['link']; ?>"><?php echo $story['link']; ?></a></p>
    <!--prints the link out as itself-->
    <h2>Comments</h2>
    <?php
    if(isset($_SESSION['userName'])){ //only allows the user to comment if they are logged in
        require "addCommentForm.php";
    }
    ?>
    <br>
    <ul>
        <?php
        if ($comment_result->num_rows > 0) {
            while ($row = $comment_result->fetch_assoc()) {
                echo "<li>" . $row["userWhoCreated"] . ": " . $row["body"] . "</li>";
                if (isset($_SESSION['userName'])) {
                    if ($row["userWhoCreated"] == $_SESSION['userName']) { //the owner of the comment is the only one to be able to edit comments
                        echo ' <form action="editComment.php" method="post" style="display:inline;">
                            <input type="hidden" name="commentID" value="' . $row["commentID"] . '">
                            <input type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="storyID" value="' . $story_id . '">
                            <input type="text" name="newBody" value="' . $row["body"] . '">
                            <input type="submit" value="Edit">
                            </form>'; //creates a text box with the current value of the body with an edit button
                        echo ' <form action="deletecomment.php" method="post">
                            <input type="hidden" name="commentID" value="' . $row["commentID"] . '">
                            <input type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="storyID" value="' . $story_id . '">
                            <input type="submit" value="Delete">
                            </form>'; //creates a delete button with only hidden fields
                    }
                }
                echo "</li>";
            }
        } else {
            echo "No comments yet.";
        }
        $mysqli->close();
        ?>
    </ul>

</body>

</html>