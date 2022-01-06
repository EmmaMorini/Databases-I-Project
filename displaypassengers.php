<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gettripdata.css">
    <title>Display Passengers</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>

    <?php
    // Select passenger and passport info for all passengers
    $passengersinfo = "SELECT passenger.passengerid, firstname, lastname, passportnum, expirydate, countryofcitizenship, birthdate FROM passenger, passport WHERE passport.passengerid=passenger.passengerid ORDER BY lastname";
    $result = mysqli_query($connection,$passengersinfo);
    if (!$result) {
        die("databases query failed.");
    }

    // Display passenger and passport info table
    echo "<table id='trips'><tr><th>Passenger ID</th><th>First Name</th><th>Last Name</th><th>Passport</th><th>Passport Expiry</th><th>Country of Citizenship</th><th>Birthdate</th>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>" . $row["passengerid"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["passportnum"] . "</td><td>" . $row["expirydate"] . "</td><td>" . $row["countryofcitizenship"] . "</td><td>" . $row["birthdate"] . "</td></tr>";
    }

    echo "</table>";
    mysqli_free_result($result);

    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>