<?php

function city_avatar($id, $absolute = false)
{
    $city = city_fetch($id);
    return $city['image'] ? $city['image'] : 'https://cdn.brickmmo.com/images@1.0.0/no-city.png';
}

function city_fetch_all()
{

    global $connect;

    $query = 'SELECT *
        FROM cities
        ORDER BY name';
    $result = mysqli_query($connect, $query);

    $data = array();

    while($record = mysqli_fetch_assoc($result))
    {
        $data[] = $record;
    }
    
    return $data;

}

function city_fetch($identifier, $field = false)
{

    if(!$identifier) return false;

    global $connect;

    if($field)
    {
        $query = 'SELECT *
            FROM cities
            WHERE '.$field.' = "'.addslashes($identifier).'"
            LIMIT 1';
    }
    else
    {
        $query = 'SELECT *
            FROM cities
            WHERE id = "'.addslashes($identifier).'"
            AND deleted_at IS NULL
            LIMIT 1';
    }
    
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result)) return mysqli_fetch_assoc($result);
    else return false;

}

function city_check()
{

    global $_city, $_user, $connect;

    if(!$_city)
    {
        $query = 'SELECT cities.*
            FROM cities
            INNER JOIN city_user
            ON cities.id = city_user.city_id
            WHERE city_user.user_id = '.$_user['id'].'
            AND current = 1';
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result))
        {
            $_city = mysqli_fetch_assoc($result);
        }
    }
    
    if(!$_city)
    {
        city_set($_user['id']);
        header_redirect(ENV_DOMAIN.'/console/dashboard');
    }

}

function city_seeder($identifier)
{

    global $connect;

    $data = '<?php

use App\Models\Road;
use App\Models\Track;
use App\Models\Building;
use App\Models\Square;
use App\Models\SqureImage;

// **************************************************'.chr(13).
        '// Roads'.chr(13);

    $query = 'SELECT *
        FROM roads
        WHERE city_id = "'.$identifier.'"
        ORDER BY id';
    $result = mysqli_query($connect, $query);

    while($record = mysqli_fetch_assoc($result))
    {
        $data .= 'Road::factory()->create([';
        foreach($record as $key => $value)
        {
            $data .= '"'.$key.'" => "'.$value.'",';
        }
        $data .= ']);'.chr(13);
    }

    $data .= str_repeat(chr(13), 2).
        '// **************************************************'.chr(13).
        '// Tracks'.chr(13);

    $query = 'SELECT *
        FROM tracks
        WHERE city_id = "'.$identifier.'"
        ORDER BY id';
    $result = mysqli_query($connect, $query);

    while($record = mysqli_fetch_assoc($result))
    {
        $data .= 'Track::factory()->create([';
        foreach($record as $key => $value)
        {
            if($value)
            {
                $data .= '"'.$key.'" => "'.$value.'",';
            }
        }
        $data .= ']);'.chr(13);
    }

    $data .= str_repeat(chr(13), 2).
        '// **************************************************'.chr(13).
        '// Buildings'.chr(13);

    $query = 'SELECT *
        FROM buildings
        WHERE city_id = "'.$identifier.'"
        ORDER BY id';
    $result = mysqli_query($connect, $query);

    while($record = mysqli_fetch_assoc($result))
    {
        $data .= 'Building::factory()->create([';
        foreach($record as $key => $value)
        {
            if($value)
            {
                $data .= '"'.$key.'" => "'.$value.'",';
            }
        }
        $data .= ']);'.chr(13);
    }

    $data .= str_repeat(chr(13), 2).
        '// **************************************************'.chr(13).
        '// Squares'.chr(13);

    $query = 'SELECT *
        FROM squares
        WHERE city_id = "'.$identifier.'"
        ORDER BY id';
    $result = mysqli_query($connect, $query);

    while($record = mysqli_fetch_assoc($result))
    {
        $data .= '$square = Square::factory()->create([';
        foreach($record as $key => $value)
        {
            $data .= '"'.$key.'" => "'.$value.'",';
        }
        $data .= ']);'.chr(13);

        $roads = square_roads($record['id'], true);
        if(count($roads)) $data .= '$square->roads()->attach(['.implode(',', $roads).']);'.chr(13);

        $tracks = square_tracks($record['id'], true);
        if(count($tracks)) $data .= '$square->tracks()->attach(['.implode(',', $tracks).']);'.chr(13);

    }

    /*
    $data .= str_repeat(chr(13), 2).
        '// **************************************************'.chr(13).
        '// Buildings'.chr(13);

    $query = 'SELECT *
        FROM buildings
        WHERE city_id = "'.$identifier.'"
        ORDER BY id';
    $result = mysqli_query($connect, $query);

    while($record = mysqli_fetch_assoc($result))
    {
        $data .= 'Track::factory()->create([';
        foreach($record as $key => $value)
        {
            $data .= '"'.$key.'" => "'.$value.'",';
        }
        $data .= ']);'.chr(13);
    }
        */

    return $data;

    /*
    Setting::factory()->create([
        'name' => $value['name'],
        'value' => $value['value'],
    ]);
    */
}

function city_set($user_id, $city_id = false)
{

    global $connect; 
    
    if($city_id)
    {

        $query = 'UPDATE city_user SET
            current = 0
            WHERE user_id = '.$user_id;
        mysqli_query($connect, $query);

        $query = 'UPDATE city_user SET
            current = 1
            WHERE city_id = '.$city_id.'
            AND user_id = '.$user_id.'
            LIMIT 1';
        mysqli_query($connect, $query);

    }
    else
    {

        $query = 'SELECT cities.id
            FROM cities
            INNER JOIN city_user 
            ON city_user.city_id = cities.id
            WHERE city_user.user_id = '.$user_id.'
            AND deleted_at IS NULL
            ORDER BY created_at DESC
            LIMIT 1';
        $result = mysqli_query($connect, $query);

        if(mysqli_num_rows($result))
        {
            $record = mysqli_fetch_assoc($result);
            city_set($user_id, $record['id']);
        }

    }

}

