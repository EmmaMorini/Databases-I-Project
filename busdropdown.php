<!-- Programmer Name: 00 -->
<?php
$result = mysqli_query($connection,$busses);
if (!$result) {
    die("databases query failed.");
}
// Display entries in the bustrips table
echo "<label for='selectbus'>Bus:</label>";
echo "<select name='selectbus' id='selectbus' required> <option value='' selected disabled='disabled'>Select Bus Here</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value=". $row[licenseplatenum] . ">" . $row[licenseplatenum] . "</option>";
    }

echo "</select>";

mysqli_free_result($result);
?>