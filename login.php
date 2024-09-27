<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
</head>
<body>
<h1>Existing User</h1>
<form name="LogIn" action="processLogin.php" method="post" autocomplete="off">
    <p>
        <label for="user">Username:</label>
        <input type="text" name="user" id="user" /> <!--creates a simple form with entry and a submit-->
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" /> <!--creates a simple form with entry and a submit-->
    </p>
    <p>
        <input type="submit" value="Log In!" />
    </p>
</form>
<h1>New User</h1>
<form name="createUser" action="processAccountCreation.php" method="post" autocomplete="off">
    <p>
        <label for="user">Username:</label>
        <input type="text" name="user" id="user" /> <!--creates a simple form with entry and a submit-->
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" /> <!--creates a simple form with entry and a submit-->
    </p>
    <p>
        <input type="submit" value="Create Account!" />
    </p>
</form>
</body>
</html>