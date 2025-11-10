<?php

define('APP_NAME', 'QR Codes');
define('PAGE_TITLE', 'Dashboard');
define('PAGE_SELECTED_SECTION', '');
define('PAGE_SELECTED_SUB_PAGE', '');

include('../templates/html_header.php');
include('../templates/nav_header.php');
include('../templates/nav_slideout.php');
include('../templates/nav_sidebar.php');
include('../templates/main_header.php');

include('../templates/message.php');

$query = 'SELECT *
    FROM events
    WHERE ends_at > NOW()
    ORDER BY starts_at
    LIMIT 5';
$result = mysqli_query($connect, $query);

?>

<main>   
    
    <div class="w3-center">
        <h1>Upcoming events</h1>
    </div>

    <hr>

    <?php while ($record = mysqli_fetch_assoc($result)): ?>


        
                        
        <div class="w3-card-4 w3-margin-top" style="max-width:100%; height: 100%;">
            <header class="w3-container w3-purple">
                <h4 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?=$record['name']?></h4>
            </header>

            <div class="w3-flex w3-padding">
                
                <div style="width: 200px;">
                    
                </div>
                
                <div class="w3-padding" style="flex: 1;">
                        Date: <span class="w3-bold"><?=date_to_format($record['starts_at'], 'FULL')?></span>
                        <br>
                        Location: <span class="w3-bold"><?=$record['location']?></span>
                    <hr>
                    <a href="/details/<?=$record['id']?>">Event Details</a> | 
                    <?php if($record['registration']): ?>
                        <span class="w3-bold"><a href="<?=$record['registration']?>">Register Now</a></span>
                    <?php else: ?>
                        <span class="w3-bold w3-text-grey">No registration required</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

</main>

<?php

include('../templates/main_footer.php');
include('../templates/debug.php');
include('../templates/html_footer.php');