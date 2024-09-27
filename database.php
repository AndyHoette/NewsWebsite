<?php

$mysqli = new mysqli('localhost', 'joshlee', 'joshlee', 'newsWebsite');

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
?>