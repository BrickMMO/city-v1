<?php

$query = 'SELECT * 
    FROM cities ';

/*
if(isset($_GET['github']) && $_GET['github'] == 'true')
{
    $query .= 'WHERE github_username != "" ';
}
    */

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