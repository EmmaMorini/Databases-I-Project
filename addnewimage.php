<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="generalstyle.css">
    <title>Picture Upload</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>
    <?php
    $tripid = $_POST["tripid"];
    $url = $_POST["newimage"];

    // Check file type
    $temp = explode(".", $url);
    $tempext = end($temp);
    $extension = strtolower($tempext);
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    if (!in_array($extension, $allowedExts)) {
        die('Not a valid file type. File must be one of: gif, jpeg, jpg, png');
    }
    
    // Validate image URL
    if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        die('Not a valid URL');
    } else { // If image URL is valid, add it to the correct database entry
        $query = "UPDATE bustrip SET urlimage='" . $url . "'" . "WHERE tripid=" . $tripid;
        if (!mysqli_query($connection, $query)) {
            die("Error: insert failed" . mysqli_error($connection));
        }
        // Confirm successful insertion of image and display it in user interface
        echo "<hr>";
        echo "<div>";
        echo "Your image was added!";
        echo "<br>";
        echo "<br>";
        echo '<img src="' . $url . '" height="200" width="200">';
        echo "</div>";
        echo "<hr>";
    }
    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>