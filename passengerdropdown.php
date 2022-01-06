<!-- Programmer Name: 00 -->
<?php
$result = mysqli_query($connection,$passengers);
if (!$result) {
    die("databases query failed.");
}
// Display passengers
echo "<select name='selectpassenger' id='selectpassenger' required> <option value='' selected disabled='disabled'>Select Passenger Here</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value=". $row[passengerid] . ">" . $row[firstname] . " " . $row[lastname] . "</option>";
    }

echo "</select>";

mysqli_free_result($result);
?>