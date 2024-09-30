<!--form embedded into storypage.php-->
<form name="addComment" action="processComment.php" method="post" autocomplete="off">
    <p>
        <label for="body">Add Comment:</label>
        <input type="text" name="body" id="body" /> <!--creates a simple form with entry and a submit-->
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
        <input type="hidden" name="storyID" value="<?php echo $story_id ?>" />
    </p>
    <p>
        <input type="submit" value="Add Comment" />
    </p>
</form>