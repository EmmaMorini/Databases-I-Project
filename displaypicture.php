<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="displaypicture.css">
    <title>Trip Picture</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>
    
    <?php
    // Retrieve the picture associated with the selected trip
    $tripID = $_POST["trips"];
    if ($tripID == 'default') {
        die("Must choose a trip to add a picture for");
    }
    $query = "SELECT urlimage, tripid, tripname FROM bustrip WHERE tripid=" . $tripID;
    $result = mysqli_query($connection,$query);

    if (!$result) {
        die("databases query failed.");
    }
    // Display default picture if no trip picture currently exists and allow user to set a pictrue
    $row=mysqli_fetch_assoc($result);
    if (is_null($row["urlimage"])) {
        echo '<img src="images\island.jpg" height="200" width="200">';
        echo "<br>";
        echo "No trip image currently exists";
        echo "<br><hr>";
        echo "<h2>Upload image for:</h2>";
        echo "<form action='addnewimage.php' method='post'>";
        echo "<input type='radio' name='tripid' value='" . $row[tripid] . "' checked>" . $row[tripname] . "<br>";
        echo "<br>";
        echo "Add trip image URL: <input type='text' name='newimage' required><br>";
        echo "<br>";
        echo "<input type='submit' value='Add New Picture'>";
        echo "</form>";
    // If trip picture already exists, inform user and prompt to update the picture
    } else {
        echo "<hr>";
        echo "<div>";
        echo "Trip image already exists:";
        echo "<br>";
        echo '<img src="' . $row[urlimage] . '" height="200" width="200" id="tripimage">';
        echo "<form action='addnewimage.php' method='post'>";
        echo "<label for='tripid'>Showing picture for:</label><br>";
        echo "<input type='radio' name='tripid' value='" . $row[tripid] . "' checked>" . $row[tripname] . "<br>";
        echo "<br>";
        echo "Replace picture? <input type='text' name='newimage' required><br>";
        echo "<br>";
        echo "<input type='submit' value='Add New Picture'>";
        echo "</form>";
        echo "</div>";
        echo "<hr>";
    }
    mysqli_free_result($result);
    ?>

    <?php
    mysqli_close($connection); // Close database connection
    ?>
    
</body>
</html>