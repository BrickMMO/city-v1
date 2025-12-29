<?php

if(!isset($_GET['hash']) || !invite_fetch($_GET['hash']))
{
    message_set('City Invite Error', 'There was an error with the invite link, please try again.', 'red');
    header_redirect(ENV_SSO_DOMAIN.'/login');
}

$_SESSION['invite'] = $_GET['hash'];

$invite = invite_fetch($_SESSION['invite']);
$invite_url = ENV_DOMAIN.'/action/invite/hash/'.$invite['invite_hash'];

if($_user)
{

    $query = 'SELECT *
        FROM city_user
        WHERE user_id = '.$_user['id'].'
        AND city_id = '.$invite['city_id'].'
        LIMIT 1';
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result))
    {

        unset($_SESSION['invite']);

        message_set('Invitation Error', 'You are already a member of this city.', 'red', true);
        header_redirect(ENV_DOMAIN.'/action/select/id/'.$invite['city_id']);

    }

    $query = 'INSERT INTO city_user (
            city_id,
            user_id
        ) VALUES (
            '.$invite['city_id'].',
            '.$_user['id'].'
        )';
    mysqli_query($connect, $query); 
    
    unset($_SESSION['invite']);

    // Add use to city and redirect to city dashbaord
    message_set('City Invite Success', 'You have been added to a new city.');
    header_redirect(ENV_DOMAIN.'/action/select/id/'.$invite['city_id']);

}
else
{

    message_set('City Invite Success', 'You have been invited to join a city, please login or register to accept invitation.');
    header_redirect(ENV_SSO_DOMAIN.'/?redirect='.urlencode($invite_url));

}   
