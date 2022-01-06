<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gettripdata.css">
    <title>Display Empty Bookings</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>

    <?php
    // Select trips with no bookings
    $emptytrips = "SELECT * FROM bustrip WHERE tripid NOT IN (SELECT tripid FROM booking)";
    $result = mysqli_query($connection,$emptytrips);
    if (!$result) {
        die("databases query failed.");
    }

    // Display trips with no bookings
    echo "<table id='trips'><tr><th>TripID</th><th>Start Date</th><th>End Date</th><th>Country</th><th>Trip Name</th><th>Bus License Plate</th>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>" . $row["tripid"] . "</td><td>" . $row["startdate"] . "</td><td>" . $row["enddate"] . "</td><td>" . $row["countryvisited"] . "</td><td>" . $row["tripname"] . "</td><td>" . $row["licenseplatenum"] . "</td></tr>";
    }

    echo "</table>";
    mysqli_free_result($result);
    
    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>