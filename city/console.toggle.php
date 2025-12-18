<?php

security_check();

define('APP_NAME', 'QR Codes');
define('PAGE_TITLE', 'Dashboard');
define('PAGE_SELECTED_SECTION', 'qr-codes');
define('PAGE_SELECTED_SUB_PAGE', '/console/dashboard');

include('../templates/html_header.php');
include('../templates/nav_header.php');
include('../templates/nav_sidebar.php');
include('../templates/main_header.php');

include('../templates/message.php');

$query = 'SELECT cities.*, city_user.current
    FROM cities
    INNER JOIN city_user 
    ON cities.id = city_user.city_id
    ORDER BY cities.name';    
$result = mysqli_query($connect, $query);

?>

<h1 class="w3-margin-top w3-margin-bottom">
    <img
        src="https://cdn.brickmmo.com/icons@1.0.0/city.png"
        height="50"
        style="vertical-align: top"
    />
    Toggle City
</h1>

<hr>



<?php

include('../templates/main_footer.php');
include('../templates/debug.php');
include('../templates/html_footer.php');