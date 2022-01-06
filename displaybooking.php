<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gettripdata.css">
    <title>Display Passenger Bookings</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>

    <?php
    // Select all bookings
    $passengerid = $_POST["selectpassenger"];
    $bookings = "SELECT * FROM booking WHERE passengerid=" . $passengerid;
    $result = mysqli_query($connection,$bookings);
    if (!$result) {
        die("database query failed.");
    }

    // Display booking info table for sleected user
    echo "<table id='trips'><tr><th>Passenger ID</th><th>Trip ID</th><th>Price</th>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>" . $row["passengerid"] . "</td><td>" . $row["tripid"] . "</td><td>" . $row["price"] . "</td></tr>";
    }

    echo "</table>";
    mysqli_free_result($result);

    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>