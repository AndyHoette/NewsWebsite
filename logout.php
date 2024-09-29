<?php
session_destroy();
session_unset();
exit;
header("location:home.php");
?>
