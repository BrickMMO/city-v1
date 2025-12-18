<?php

$query = 'SELECT * 
    FROM cities ';

if(isset($_GET['user_id']) && is_numeric($_GET['user_id']))
{
    $query .= 'WHERE user_id != "'.$_GET['user_id'].'" ';
}

$query .= 'ORDER BY name'; 
$result = mysqli_query($connect, $query);

$users = array();

if(mysqli_num_rows($result))
{

    while($user = mysqli_fetch_assoc($result))
    {

        $cities[]= $user;
        
    }

    $data = array(
        'message' => 'Cities retrieved successfully.',
        'error' => false, 
        'cities' => $cities,
    );
    
}
else 
{

    $data = array(
        'message' => 'Error retrieving cities.',
        'error' => true,
        'users' => null,
    );

}