<?php

include('includes/connect.php');
include('includes/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if($_POST['password'] == EXPORT_PASSWORD)
    {

        $_SESSION['logged_in'] = true;

        header('Location: export.php');
        die();

    }

    header('Location: login.php');
    die();

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BrickMMO</title>

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

        <h1>Login</h1>

        <form method="post">

            <label style="display: block; margin-bottom: 10px;">
                <input type="password" name="password" id="password" placeholder="password" style="width: 100%; margin-bottom: 10px; text-align: center;">
            </label>
            
            <input type="submit" value="Login" onclick="return validateForm()" style="width: 100%;">

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
