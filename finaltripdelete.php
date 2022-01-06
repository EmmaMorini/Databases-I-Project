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
    include 'connectdb.php';
    ?>
    
    <?php
    session_start();
    $tripID = $_SESSION['tripid'];
    $confirm = $_POST["confirm"];
    $query1 = "SELECT COUNT(*) FROM booking WHERE tripid=" . $tripID;
    $result = mysqli_query($connection,$query1);

    if (!$result) {
        die("databases query failed.");
    }

    $row=mysqli_fetch_assoc($result);
    // Check if trip has bookings
    if ($confirm == 'yes') {
        if ($row["COUNT(*)"] > 0) {
            echo "Cannot delete this trip because there are bookings associated with it";
        } else {
            // If trip has no bookings, delete it
            mysqli_free_result($result);
            $query2 = "DELETE FROM bustrip WHERE tripid=" . $tripID;
            if (!mysqli_query($connection, $query2)) {
                die("Error: deletion failed" . mysqli_error($connection));
            }

            echo "<hr>";
            echo "<div>";
            echo "The trip was deleted! Go back and refresh to see your changes in effect.";
            echo "</div>";
            echo "<hr>";
        }
    } else {
        echo "Deletion aborted - please use back arrow to return to home page and refresh";
    }
    ?>

    <?php
    mysqli_close($connection); // Close database connection
    ?>
</body>
</html>