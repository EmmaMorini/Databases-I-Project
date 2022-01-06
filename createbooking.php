<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="generalstyle.css">
    <title>Booking Creation</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>
    <?php
    $tripID = $_POST["trips"];
    $passengerID = $_POST["selectpassenger"];
    $cost = $_POST["bookingprice"];
    $decimalcost = number_format((float)$cost, 2, '.', ''); // Format the cost correctly to match decimal column type in database

    // Insert new booking into table
    $query = "INSERT INTO booking (passengerid, tripid, price) VALUES (" . $passengerID . ", " . $tripID . "," . $decimalcost . ")";
    if (!mysqli_query($connection, $query)) {
        echo $query . "<br>";
        die("Error: insert failed" . mysqli_error($connection));
    }
    // Confirm successful insertion of booking
    echo "Your booking was created!";
    echo "<hr>";
    
    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>