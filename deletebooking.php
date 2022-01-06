<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="generalstyle.css">
    <title>Booking Deletion</title>
</head>
<body>
    <?php
        include 'connectdb.php'; // Open database connectio
    ?>
    <?php
    // Ensure that user has picked a booking to delete
    if (!isset($_POST["selectbooking"])) {
        die("Must choose a booking to delete");
    }
    // Extract tripid and passengerid (primary key)
    $booking = explode(" ", $_POST["selectbooking"]);
    $passengerID = $booking[0];
    $tripID = end($booking);
    session_start();
    $_SESSION['bookingtripid'] = $tripID;
    $_SESSION['bookingpassengerid'] = $passengerID;
    ?>
    
    <!-- Obtain user input -->
    <form action="finalbookingdelete.php" method="post">
    <label for="confirm">Are you sure you would like to delete this booking?</label><br>
    <input type="radio" name="confirm" value="yes">Yes<br>
    <input type="radio" name="confirm" value="no" checked>No<br>
    <input id="bookingbuttonconfirm" type="submit" value="Confirm">
    </form>
    
    <?php
    mysqli_close($connection); // Close database connection
    ?>    
</body>
</html>