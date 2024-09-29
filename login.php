<?php
//if(session_id() == '' || !isset($_SESSION)) {
//    session_start();
//    $_SESSION['token'] = bin2hex(random_bytes(32));
//    echo "createdSession";
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
</head>
<body>
<h1>
<?php
/*if(isset($_SESSION['userName'])){
    echo $_SESSION['userName'];
}*/
?>
</h1>
<a href="home.php">Back to Home</a>
<h1>Existing User</h1>
<form name="LogIn" action="processLogin.php" method="post" autocomplete="off">
    <p>
        <label for="user">Username:</label>
        <input type="text" name="user" id="user" /> <!--creates a simple form with entry and a submit-->
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" /> <!--creates a simple form with entry and a submit-->
<!--        <input type="hidden" name="token" value="--><?php //echo $_SESSION['token']; ?><!--" />-->
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
        <input type="password" name="password" id="password" /> <!--creates a simple form with entry and a submit-->
<!--        <input type="hidden" name="token" value="--><?php //echo $_SESSION['token']; ?><!--" />-->
    </p>
    <p>
        <input type="submit" value="Create Account!" />
    </p>
</form>
</body>
</html>