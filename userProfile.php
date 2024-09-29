<?php
session_start();
if(isset($_SESSION['userName'])) {
    echo "<p>Hello " . $_SESSION['userName'] . "</p>";
    echo "<a href='logout.php'>Log Out</a>";
}
else{
    echo "<p>uh oh</p>";
    //header("Location: home.php");
}
?>