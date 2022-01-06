<!-- Programmer Name: 00 -->
<?php
$result = mysqli_query($connection,$countries);
if (!$result) {
    die("databases query failed.");
}
// Display countries that have trips
echo "<label for='selectbus'>Country: </label>";
echo "<select name='selectcountry' id='selectcountry' required> <option value='' selected disabled='disabled'>Select Country Here</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value=". $row[countryvisited] . ">" . $row[countryvisited] . "</option>";
    }

echo "</select>";

mysqli_free_result($result);
?>