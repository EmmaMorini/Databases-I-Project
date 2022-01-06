<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="generalstyle.css">
    <title>Info Update</title>
</head>
<body>
    <!-- Open database connection -->
    <?php
    include 'connectdb.php';
    ?>
    <?php
    // Check that start date is before end date
    if (strtotime($_POST['startdate']) > strtotime($_POST['enddate'])) {
        die("Error: start date must be before end date");
    }

    $tripid = $_POST["trips"];
    $tripname = $_POST["tripname"];
    $start = $_POST["startdate"];
    $end = $_POST["enddate"];

    // Update fields that were filled out in the form
    if (!empty($tripname)) { // If trip name was not filled out, do not change that field
        $lowertripname = strtolower($tripname);
        $check = "SELECT COUNT(*) FROM bustrip WHERE LOWER(tripname)='" . $lowertripname . "'";
        $checkresult = mysqli_query($connection,$check);
        if (!$checkresult) {
            die("databases query failed.");
        }
        $row=mysqli_fetch_assoc($checkresult);
    
        if ($row["COUNT(*)"] > 0) {
            die("Cannot update this trip because the name ". $tripname . " already exists.");
        }

        mysqli_free_result($checkresult);

        $query1 = "UPDATE bustrip SET tripname='" . $tripname . "'" . "WHERE tripid=" . $tripid;
        if (!mysqli_query($connection, $query1)) {
            die("Error: update failed " . mysqli_error($connection));
        }
    }
    // Update start date
    if (!isset($start) || $start != 'yyyy-mm-dd') {
        $query2 = "UPDATE bustrip SET startdate='" . $start . "'" . "WHERE tripid=" . $tripid;
        if (!mysqli_query($connection, $query2)) {
            die("Error: update failed " . mysqli_error($connection));
        }
    } else {
        echo "Start date not updated";
    }
    // Update end date
    if (!is_null($end) || $end != 'yyyy-mm-dd') {
        $query3 = "UPDATE bustrip SET enddate='" . $end . "'" . "WHERE tripid=" . $tripid;
        if (!mysqli_query($connection, $query3)) {
            die("Error: update failed " . mysqli_error($connection));
        }
    } else {
        echo "End date not updated";
    }
    // Confirm successful insertion of image and display it in user interface
    echo "<hr>";
    echo "<div>";
    echo "Your data was updated! Use back arrow and refresh to see your changes in effect";
    echo "</div>";
    echo "<hr>";
    // Close database connection
    mysqli_close($connection);
    ?>    
</body>
</html>