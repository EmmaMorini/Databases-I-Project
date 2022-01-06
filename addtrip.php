<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="generalstyle.css">
    <title>New Trip</title>
</head>
<body>
    <?php
    include 'connectdb.php'; // Open database connection
    ?>
    <?php
    // Check that all required trip info has been filled out
    if (!isset($_POST["newtrip"]) || !isset($_POST["newstartdate"]) || !isset($_POST["newenddate"]) || !isset($_POST["newtripcountry"]) || !isset($_POST["selectbus"])) {
        die("Please fill out all information");
    }

    // Check that start date is before end date
    if (strtotime($_POST['newstartdate']) > strtotime($_POST['newenddate'])) {
        die("Error: start date must be before end date");
    }

    $tripname = $_POST["newtrip"];
    $lowertripname = strtolower($tripname);
    $start = $_POST["newstartdate"];
    $end = $_POST["newenddate"];
    $country = $_POST["newtripcountry"];
    $imageurl = $_POST["newtripimage"];
    $bus = $_POST["selectbus"];

    // Check that trip does not already exist in the database
    $check = "SELECT COUNT(*) FROM bustrip WHERE LOWER(tripname)='" . $lowertripname . "'";
    $checkresult = mysqli_query($connection,$check);

    if (!$checkresult) {
        die("databases query failed.");
    }

    $row=mysqli_fetch_assoc($checkresult);

    if ($row["COUNT(*)"] > 0) {
        die("Cannot insert this trip because ". $tripname . " already exists.");
    }

    mysqli_free_result($checkresult);

    // Create new unique ID for new trip
    $query= 'SELECT MAX(tripid) AS maxid FROM bustrip';
    $result=mysqli_query($connection,$query);
    if (!$result) {
            die("database max query failed.");
    }
    $row=mysqli_fetch_assoc($result);
    $newkey = intval($row["maxid"]) + 1;
    $tripid = (string)$newkey;

    // Insert new trip into table
    $query = "INSERT INTO bustrip (tripid, startdate, enddate, countryvisited, tripname, licenseplatenum) VALUES (" . $tripid . ", '" . $start . "', '" . $end . "', '" . $country . "', '" . $tripname . "', '" . $bus . "');";
    if (!mysqli_query($connection, $query)) {
            die("Error: insert failed" . mysqli_error($connection));
        }
        echo "The trip was added! Use back arrow and refresh to see it appear in the trips table.";

    mysqli_free_result($result);
    
    // Close database connection
    mysqli_close($connection);
    ?>
</body>
</html>