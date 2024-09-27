<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Story</title>
</head>


<body>
    <?php
    require "database.php";
    $sqlStory = "SELECT title, body, link FROM Stories";

    $result = $conn->query($sqlStory);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<br> id: " . $row["title"] . " - Name: " . $row["body"] . " " . $row["link"] . "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();

    ?>
</body>

</html>