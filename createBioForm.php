<form name="CreateBio" action="createBio.php" method="post" autocomplete="off">
    <p>
        <label for="bio">Add Bio:</label>
        <input type="text" name="bio" id="bio" /> <!--creates a simple form with entry and a submit-->
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
    </p>
    <p>
        <input type="submit" value="Log In!" />
    </p>
</form>
