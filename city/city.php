<?php

$city = city_fetch($_GET['key'], 'url');

if(!$city)
{
    message_set('City error', 'This city does not exist.', 'red');
    include('../404.php');
    die();
}

define('APP_NAME', 'City');
define('PAGE_TITLE', $city['name']);
define('PAGE_SELECTED_SECTION', '');
define('PAGE_SELECTED_SUB_PAGE', '');

include('../templates/html_header.php');
include('../templates/login_header.php');

?>

<div class="w3-center">

    <h1>CITY PROFILE</h1>

    <h2>    
        <?=$city['name']?>
    </h2>

</div>

<?php

include('../templates/login_footer.php');
include('../templates/debug.php');
include('../templates/html_footer.php');
