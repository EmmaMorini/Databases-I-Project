<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gettripdata.css">
    <title>Trip Deletion</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>
    
    <?php
    session_start();

    $tripID = $_SESSION['bookingtripid'];
    $passengerID = $_SESSION['bookingpassengerid'];
    $confirm = $_POST["confirm"];

    // Either delete trip or do nothing based on user's input
    if ($confirm == 'yes') {
        $query = "DELETE FROM booking WHERE tripid=" . $tripID . " AND passengerid=" . $passengerID;
        if (!mysqli_query($connection, $query)) {
            die("Error: deletion failed - " . mysqli_error($connection));
        }

        echo "<hr>";
        echo "<div>";
        echo "The booking was deleted! Go back and refresh to see your changes in effect.";
        echo "</div>";
        echo "<hr>";
    } else {
        echo "Deletion aborted - please use back arrow to return to home page and refresh";
    }
    ?>

    <?php
    mysqli_close($connection); // Close database connection
    ?> 
</body>
</html>