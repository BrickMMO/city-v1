<?php

security_check();
city_check();

if (isset($_GET['uninvite'])) 
{

    if(!$user = user_fetch($_GET['uninvite']))
    {
        message_set('Delete Error', 'There was an error removing this member from the city.', 'red');
        header_redirect('/console/members');
    }

    $query = 'DELETE FROM city_user 
        WHERE user_id = '.$user['id'].'
        AND city_id = '.$_city['id'].'
        LIMIT 1';
    mysqli_query($connect, $query);

    city_set();

    message_set('Delete Success', 'Member has been removed from this city.');
    header_redirect('/console/dashboard');
    
}

define('APP_NAME', $_city['name']);

define('PAGE_TITLE', 'Members');
define('PAGE_SELECTED_SECTION', '');
define('PAGE_SELECTED_SUB_PAGE', '');

include('../templates/html_header.php');
include('../templates/nav_header.php');
include('../templates/nav_slideout.php');
include('../templates/main_header.php');

include('../templates/message.php');

$users = users_fetch();

$query = 'SELECT city_user.*
    FROM city_user
    WHERE city_user.city_id = '.$_city['id'].'
    ORDER BY updated_at DESC';
$result = mysqli_query($connect, $query);

?>

<!-- CONTENT -->

<h1 class="w3-margin-top w3-margin-bottom">
    <img
        src="https://cdn.brickmmo.com/icons@1.0.0/sso.png"
        height="50"
        style="vertical-align: top"
    />
    <?=$_city['name']?>
</h1>
<p>
    <a href="/console/dashboard">Dashboard</a> / 
    Members
</p>
<hr />

<h2>Members</h2>

<table class="w3-table w3-bordered w3-striped w3-margin-bottom">
    <tr>
        <th class="bm-table-icon"></th>
        <th class="bm-table-icon"></th>
        <th>Name</th>
        <th>GitHub</th>
        <th class="bm-table-icon"></th>
    </tr>

    <?php while($record = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td>
                <img
                    src="<?=user_avatar($record['user_id']);?>"
                    style="height: 25px"
                    class="w3-circle"
                />
            </td>
            <td>
                <?php if($record['city_id'] == $_city['id']): ?>
                    <i class="fa-solid fa-lock"></i>
                <?php endif; ?>
            </td>
            <td>
                <?=$users[$record['user_id']]['first']?> <?=$users[$record['user_id']]['last']?>
            </td>
            <td>
                <?php if($users[$record['user_id']]['github_username']): ?>
                    <a href="https://github.com/<?=$users[$record['user_id']]['github_username']?>">
                        <i class="fa-brands fa-github"></i>
                        <?=$users[$record['user_id']]['github_username']?>
                    </a>
                <?php endif; ?>
            </td>
            <td>
                <?php if($record['user_id'] != $_user['id'] && $record['user_id'] != $_city['user_id']): ?>
                    <a href="#" onclick="return confirmModal('Are you sure you want to remove <?=user_name($record['user_id'])?> from <?=$_city['name']?>?', '/console/members/uninvite/<?=$record['user_id']?>');">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>

</table>

<a
    href="/console/invite/"
    class="w3-button w3-white w3-border"
>
    <i class="fa-solid fa-envelope fa-padding-right"></i> Invite New Member
</a>
    
<?php

include('../templates/modal_city.php');

include('../templates/main_footer.php');
include('../templates/debug.php');
include('../templates/html_footer.php');
