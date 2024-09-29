<!--Just a form that is in bedded into User Profile if the user doesn't already have a bio-->
<form name="CreateBio" action="createBio.php" method="post" autocomplete="off">
    <p>
        <label for="bio">Add Bio:</label>
        <input type="text" name="bio" id="bio" /> <!--creates a simple form with entry and a submit-->
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
    </p>
    <p>
        <input type="submit" value="Create Bio" />
    </p>
</form>
