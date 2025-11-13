<?php

include('includes/connect.php');
include('includes/functions.php');

if(!isset($_SESSION['logged_in']))
{
    header('Location: login.php');
    die();
}

if(isset($_GET['list']))
{

    $query = 'SELECT *
        FROM emails
        WHERE '.$_GET['list'].' = "yes"';
    $result = mysqli_query($connect, $query);

    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=".$_GET['list'].".csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo 'id,hash,emails,socials,advanced,news,ip,created_at,updated_at'.chr(13);

    while($record = mysqli_fetch_assoc($result))
    {
        echo implode(',', $record).chr(13);
    }

    die();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export | BrickMMO</title>

    <!-- W3 School CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />

    <!-- BrickMMO Exceptions -->
    <link rel="stylesheet" href="https://cdn.brickmmo.com/exceptions@1.0.0/w3.css" />
    <link rel="stylesheet" href="https://cdn.brickmmo.com/exceptions@1.0.0/fontawesome.css" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

</head>
<body>

    <div class="w3-container w3-center" style="max-width: 400px; margin: 100px auto 20px; font-size: 120%;">

        <a href="http://brickmmo.com">
            <img src="images/brickmmo-logo.png" style="width: 100%; max-width: 200px;">
        </a>

        <hr>
    
        <h1>Export List</h1>
    
        <div style="margin: 20px auto;">
            
            <a href="export.php?list=news">Export News</a>
            <br>
            <a href="export.php?list=socials">Export Socials</a>
            <br>
            <a href="export.php?list=advanced">Export Advanced</a>

        </div>

        <div style="margin: 20px auto;">
            
            <a href="logout.php">Logout</a>

        </div>

        <hr>

        <div id="link">
            <a href="https://brickmmo.com">brickmmo.com</a> | 
            <a href="https://codeadam.ca">codeadam.ca</a>
        </div>

    </div>

    <script src="https://cdn.brickmmo.com/bar@1.0.0/bar.js"></script>

</body>
</html>
