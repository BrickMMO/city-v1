<?php

include('includes/connect.php');
include('includes/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $query = 'SELECT *
        FROM emails
        WHERE email = "'.$_POST['email'].'"
        LIMIT 1';
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result))
    {

        $record = mysqli_fetch_assoc($result);

        header('Location: update.php?hash='.$record['hash']);
        die();
    }

    $query = 'INSERT INTO emails (
            email,
            hash,
            ip
        ) VALUES (
            "'.$_POST['email'].'",
            "'.random_string().'",
            "'.get_user_ip().'"
        )';
    mysqli_query($connect, $query);

    header('Location: signup.html');
    die();

}


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | BrickMMO</title>
    
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

        <form method="post" style="margin-top: 20px;">

            <input type="email" name="email" id="email" placeholder="email@domain.com" style="width: 100%; margin-bottom: 10px; text-align: center;">

            <input type="submit" value="Sign Up" onclick="return validateForm()" style="width: 100%;">

            <div id="email-error" style="margin: 5px; color: #f00;"></div>

        </form>

        <hr>

        <div id="link">
            <a href="https://brickmmo.com">brickmmo.com</a> | 
            <a href="https://codeadam.ca">codeadam.ca</a>
        </div>

    </div>

    <script>

    function validateForm() {
        let errors = 0;

        let email_pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$";
        let email = document.getElementById("email");
        let email_error = document.getElementById("email-error");
        email_error.innerHTML = "";
        if (email.value == "") {
            email_error.innerHTML = "(email is required)";
            errors++;
        } else if (!email.value.match(email_pattern)) {
            email_error.innerHTML = "(email is invalid)";
            errors++;
        }

        if (errors) return false;
    }

    </script>

    <script src="https://kit.fontawesome.com/a74f41de6e.js" crossorigin="anonymous"></script>

    <script src="https://cdn.brickmmo.com/bar@1.0.0/bar.js"></script>

</body>
</html>
