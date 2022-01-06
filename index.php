<!-- Programmer Name: 00 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400&display=swap" rel="stylesheet">
    <title>Bus Trips (CS 3319A - Assignment 3)</title>
</head>
<body>
    <!-- Open database connection -->
    <?php
        include 'connectdb.php';
    ?>
    <img src="images\bus-304247_1280.png" alt="bus cartoon picture" id="buspicture">
    <h1>Bus Trips Around the World</h1> 
    <br>
    <!-- Get user to decide how the would like to see the data displayed -->
    <!-- Data must be displayed before actions can be taken -->
    <div id="buttonarea">
        <form action="gettripdata.php" method="post" enctype="multipart/form-data">
            Sort data by: <br>
            <input type="radio" name="field" value="countryvisited" checked>Country<br>
            <input type="radio" name="field" value="tripname">Trip name<br>
            <br>
            In what order: <br>
            <input type="radio" name="order" value="ASC" checked>Ascending<br>
            <input type="radio" name="order" value="DESC">Descending<br>
            <br>
            <input id="button1" type="submit" value="List Trip Data">
        </form>
    </div>
    <?php
        mysqli_close($connection); // Close database connection
    ?>
</body>
</html>