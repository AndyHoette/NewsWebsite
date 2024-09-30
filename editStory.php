<?php
session_start();
$storyID = $_POST["storyID"];
if(!isset($_SESSION['token'])){
    $_SESSION['token'] = bin2hex(random_bytes(32)); //if we need a token we should generate one
}
require "database.php";
$stmt = $mysqli->prepare("SELECT title, body, link FROM Stories WHERE StoryID = ?");
$stmt->bind_param("i", $storyID);
$stmt->bind_result($title, $body, $link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Story</title>
</head>
<body>
<form name="deleteStory" action="deleteStory.php" method="post" autocomplete="off">
    <p>
        <input type="hidden" name="storyID" value=<?php echo $storyID;?>>
        <input type="submit" value="Delete Story" />
    </p>
</form>
<form name="editStory" action="processStoryEdit.php" method="post" autocomplete="off">
    <p>
        <input type="hidden" name="storyID" value=<?php echo $storyID;?>>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value=<?php echo $title;?> /> <!--creates a simple form with entry and a submit-->
        <label for="story">Story:</label>
        <input type="text" name="story" id="story" value=<?php echo $body;?> /> <!--creates a simple form with entry and a submit-->
        <label for="link">Link:</label>
        <input type="text" name="link" id="link" value=<?php echo $link;?> /> <!--creates a simple form with entry and a submit-->
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
    </p>
    <p>
        <input type="submit" value="Edit Story" />
    </p>
</form>
</body>
</html>
