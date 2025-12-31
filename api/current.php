<?php   

if(security_is_logged_in())
{

    $query = 'SELECT cities.*, city_user.current
        FROM cities
        INNER JOIN city_user
        ON cities.id = city_user.city_id
        WHERE city_user.user_id = '.$_user['id'].'
        ORDER BY current = 1 DESC
        LIMIT 1';
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) == 0)
    {

        $data = array(
            'message' => 'User has no associated city.',
            'error' => true, 
        );
        
    }
    else
    {
        
        $city = mysqli_fetch_assoc($result);

        if($city['current'] != 1)
        {

            $update_query = 'UPDATE city_user
                SET current = 0
                WHERE user_id = '.$_user['id'];
            mysqli_query($connect, $update_query);

            $set_current_query = 'UPDATE city_user
                SET current = 1
                WHERE user_id = '.$_user['id'].'
                AND city_id = '.$city['id'].'
                LIMIT 1';
            mysqli_query($connect, $set_current_query);

        }

        $data = array(
            'message' => 'City retrieved successfully.',
            'error' => false, 
            'city' => $city,
        );

    }

}
else
{

    $data = array(
        'message' => 'User not logged in.',
        'error' => true, 
    );

}