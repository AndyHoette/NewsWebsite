<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
</head>
<body>
<a href="home.php">Back to Home</a>
<h1>Existing User</h1>
<form name="LogIn" action="processLogin.php" method="post" autocomplete="off">
    <p>
        <label for="user">Username:</label>
        <input type="text" name="user" id="user" /> <!--creates a simple form to handle logins-->
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" />
    </p>
    <p>
        <input type="submit" value="Log In!" />
    </p>
</form>
<h1>New User</h1> <!--This is a form to create a new account-->
<form name="createUser" action="processAccountCreation.php" method="post" autocomplete="off">
    <p>
        <label for="user">Username:</label>
        <input type="text" name="user" id="user" /> <!--allows the user to create a new account with a password-->
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" />
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" /> <!--since we are modifying data we need a token-->
    </p>
    <p>
        <input type="submit" value="Create Account!" />
    </p>
</form>
</body>
</html>