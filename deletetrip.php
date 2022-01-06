<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gettripdata.css">
    <title>Trip Deletion</title>
</head>
<body>
    <?php
        include 'connectdb.php'; // Open database connection
    ?>

    <?php
    // Ensure that user has picked a bus trip to delete
    if (!isset($_POST["trips"])) {
        die("Must choose a trip to delete");
    } else {
        $tripid = $_POST["trips"];
        echo '<hr>';
        echo '<form action="finaltripdelete.php" method="post">';
        echo '<label for="confirm">Are you sure you would like to delete this trip?</label><br>';
        echo '<input type="radio" name="confirm" value="yes">Yes<br>';
        echo '<input type="radio" name="confirm" value="no" checked>No<br>';
        echo '<br>';
        echo '<input id="buttonconfirm" type="submit" value="Confirm">';
        echo '</form>';
        echo '<hr>';

        session_start();
        $_SESSION['tripid'] = $tripid;
    }

    // Close database connection
    mysqli_close($connection);
    ?>  
</body>
</html>