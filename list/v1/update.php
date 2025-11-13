<?php

include('includes/connect.php');
include('includes/functions.php');

$query = 'SELECT *
    FROM emails
    WHERE hash = "'.$_GET['hash'].'"
    LIMIT 1';
$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) == 0)
{
    header('Location: error.html');
    die();
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $query = 'UPDATE emails SET
        news = "'.(isset($_POST['news']) ? 'yes' : 'no').'",
        socials = "'.(isset($_POST['socials']) ? 'yes' : 'no').'",
        advanced = "'.(isset($_POST['advanced']) ? 'yes' : 'no').'"
        WHERE hash = "'.$_GET['hash'].'"
        LIMIT 1';
    mysqli_query($connect, $query);

    header('Location: update.html');
    die();

}

$record = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Settings | BrickMMO</title>

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

        <h1>Update Settings</h1>

        <p>
            You are updating settings for:
            <br>
            <strong>
                <?=$record['email']?>
            </strong>
        </p>

        <form method="post" style="text-align: left;">

            <label style="display: block; margin-bottom: 10px;">
                <input type="checkbox" name="news" value="yes" 
                    <?=($record['news'] == 'yes' ? 'checked' : '')?>
                > <strong>News</strong>
                <br>
                <small>
                    General updates on the Smart City project, funding, 
                    events, and application launches.
                </small>
            </label>

            <label style="display: block; margin-bottom: 10px;">
                <input type="checkbox" name="socials" value="yes" 
                    <?=($record['socials'] == 'yes' ? 'checked' : '')?>
                > <strong>Socials</strong>
                <br>
                <small>
                    Social drop-ins for anyone new to LEGO&trade; or 
                    LEGO&trade; experts. 
                </small>
            </label>

            <label style="display: block; margin-bottom: 20px;">
                <input type="checkbox" name="advanced" value="yes" 
                    <?=($record['advanced'] == 'yes' ? 'checked' : '')?>
                > <strong>Advanced</strong>
                <br>
                <small>
                    Drop-in sessions for LEGO&trade; experts or 
                    aspiring LEGO&trade; experts.
                </small>
            </label>

            <input type="submit" value="Update Settings" onclick="return validateForm()" style="width: 100%;">

        </form>

        <hr>

        <div id="link">
            <a href="https://brickmmo.com">brickmmo.com</a> | 
            <a href="https://codeadam.ca">codeadam.ca</a>
        </div>

    </div>

    <script src="https://cdn.brickmmo.com/bar@1.0.0/bar.js"></script>

</body>
</html>
