<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gettripdata.css">
    <title>Bus Trips</title>
</head>
<body>
    <?php
        include 'connectdb.php'; // Open database connection
    ?>
    <!-- Display table with all trip data -->
    <div>
        <?php
            $whichField = $_POST["field"]; //get selected field value from the form
            $whichOrder = $_POST["order"]; //get selected order value from the form
            $query = "SELECT * FROM bustrip ORDER BY " . $whichField . " " . $whichOrder;
            $result = mysqli_query($connection,$query);
            if (!$result) {
                die("databases query failed.");
            }

            echo "<table id='trips'><tr><th>TripID</th><th>Start Date</th><th>End Date</th><th>Country</th><th>Trip Name</th><th>Bus License Plate</th>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><th>" . $row["tripid"] . "</td><td>" . $row["startdate"] . "</td><td>" . $row["enddate"] . "</td><td>" . $row["countryvisited"] . "</td><td>" . $row["tripname"] . "</td><td>" . $row["licenseplatenum"] . "</td></tr>";
            }

            echo "</table>";
            mysqli_free_result($result);
        ?>
    </div>

    <br>
    <hr>

    <!-- Section to upload or view trip images -->
    <div>
        <h2>Picture Upload Area</h2>
        <form action="displaypicture.php" method="post" enctype='multipart/form-data'>
            <!-- Display all trip data in a dropdown menu to give user options to interact with -->
            <?php
            include 'tripsdropdown.php';
            ?>
            <input id="picbutton" type="submit" value="Picture">
        </form>
    </div>
    <hr>
    <!-- Section to update trip name, start date, or end date -->
    <div>
        <h2>Update Trip Data</h2>
        <p>Note: to update a trip's picture, see Picture Upload Area above</p><br>
        <form action="updatetripinfo.php" method="post" enctype='multipart/form-data'>
            <?php
            include 'tripsdropdown.php';
            ?>
            <br><br>
            <label for="tripname">New Trip Name:</label>
            <input id="tripname" type="text" name="tripname"><br><br>
            <label for="startdate">New Start Date:</label>
            <input type="date" id="startdate" name="startdate" min="2010-01-01" max="2030-12-31" required><br><br>
            <label for="enddate">New End Date:</label>
            <input type="date" id="enddate" name="enddate" min="2010-01-01" max="2030-12-31" required><br><br>
            <input id="updatebutton" type="submit" value="Update">
            <!-- trip name, start date or end date -->
        </form>
    </div>
    <hr>
    <!-- Section to delete a trip -->
    <div>
        <h2>Delete Trip</h2>
        <form action="deletetrip.php" method="post" enctype='multipart/form-data'>
            <?php
            include 'tripsdropdown.php';
            ?>
            <input id="deletetripbutton" type="submit" value="Delete">
        </form>
    </div>
    <hr>
    <!-- Section to create a new trip -->
    <div>
        <h2>Add New Trip</h2>
        <form action="addtrip.php" method="post" enctype='multipart/form-data'>
            <label for="newtrip">Trip name:</label>
            <input type="text" name="newtrip" id="newtrip" required><br><br>
            <label for="newstartdate">New Start Date:</label>
            <input type="date" id="newstartdate" name="newstartdate" min="2010-01-01" max="2030-12-31" required><br><br>
            <label for="newenddate">New End Date:</label>
            <input type="date" id="newenddate" name="newenddate" min="2010-01-01" max="2030-12-31" required><br><br>
            <label for="newtripcountry">Country of trip:</label>
            <input type="text" name="newtripcountry" id="newtripcountry" required><br><br>
            <label for="newtripimage">Trip image URL (leave null if you do not wish to insert a picture):</label>
            <input type="text" name="newtripimage" id="newtripimage" value="NULL" required><br><br>
            <?php
            $busses = "SELECT * FROM bus";
            include 'busdropdown.php';
            ?>
            <br><br>
            <input id="addnewtripbutton" type="submit" value="Add Trip">
        </form>
    </div>
    <hr>
    <!-- Section to display all trips to a selected country -->
    <div>
        <h2>Show all trips to a country</h2>
        <form action="tripsbycountry.php" method="post" enctype='multipart/form-data'>
            <?php
            $countries = "SELECT DISTINCT countryvisited FROM bustrip ORDER BY countryvisited";
            include 'countriesdropdown.php';
            ?>
            <br><br>
            <input id="countrybutton" type="submit" value="Display">
        </form>
    </div>
    <hr>
    <!-- Section to create a new trip booking -->
    <div>
        <h2>Create Trip Booking</h2>
        <form action="createbooking.php" method="post" enctype='multipart/form-data'>
            <?php
            $passengers = "SELECT * FROM passenger";

            echo "Trip: ";
            include 'tripsdropdown.php';
            echo "<br><br>";
            echo "Passenger: ";
            include 'passengerdropdown.php';
            ?>
            <br><br>
            <label for="bookingprice">Booking cost:</label>
            <input type="number" name="bookingprice" id="bookingprice" required><br><br>
            <input id="addnewtripbutton" type="submit" value="Add Trip">
        </form>
    </div>
    <hr>
    <!-- Section to display a selected passenger's information as well as their passport information -->
    <div>
        <h2>Display Passengers Info</h2>
        <form action="displaypassengers.php" action="post" enctype='multipart/form-data'>
            <input id="showpassengersbutton" type="submit" value="Display">
        </form>
    </div>
    <hr>
    <!-- Section to see a selected passenger's trip bookings -->
    <div>
        <h2>See Passenger Bookings</h2>
        <form action="displaybooking.php" method="post" enctype='multipart/form-data'>
            <?php
            include "passengerdropdown.php";
            ?>
            <input id="displaybookingsbutton" type="submit" value="Display">
        </form>
    </div>
    <hr>
    <!-- Section to delete a selected booking -->
    <div>
        <h2>Delete Booking</h2>
        <form action="deletebooking.php" method="post" enctype='multipart/form-data'>
            <?php
            $bookings = "SELECT * FROM booking";
            include 'bookingsdropdown.php';
            ?>
            <input id="deletebookingbutton" type="submit" value="Delete">
        </form>
    </div>
    <hr>
    <!-- Section to display all trips with no bookings -->
    <div>
        <h2>Display Trips With No Bookings</h2>
        <form action="displayemptytrips.php" action="post" enctype='multipart/form-data'>
            <input id="emptytripsbutton" type="submit" value="Display">
        </form>
    </div>

    <hr>
    <?php
    mysqli_close($connection); // Close database connection
    ?>
</body>
</html>