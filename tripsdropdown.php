<!-- Programmer Name: 00 -->
<?php
$result = mysqli_query($connection,$query);
if (!$result) {
    die("databases query failed.");
}
// Display entries in the bustrips table
echo "<select name='trips' id='selecttrips' required> <option value='' selected disabled='disabled'>Select Trip Here</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value=". $row[tripid] . ">" . $row[tripname] . " - " . $row[countryvisited] . "</option>";
    }

echo "</select>";

mysqli_free_result($result);
?>