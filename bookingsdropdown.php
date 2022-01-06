<!-- Programmer Name: 00 -->
<?php
$result = mysqli_query($connection,$bookings);
if (!$result) {
    die("databases query failed.");
}
// Display entries in the bookings table
echo "<select name='selectbooking' id='selectbooking' required> <option value='' selected disabled='disabled'>Select Booking Here</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='". $row[passengerid] . " " . $row[tripid] . "'>" . "Passenger " . $row[passengerid] . " - Trip " . $row[tripid] . "</option>";
    }

echo "</select>";

mysqli_free_result($result);
?>