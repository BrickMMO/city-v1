<?php

function navigation_array($selected = false)
{

    $navigation = [
        [
            'title' => 'City',
            'sections' => [
                [
                    'title' => 'City',
                    'id' => 'admin-content',
                    'pages' => [
                        [
                            'icon' => 'city',
                            'url' => '/console/dashboard',
                            'title' => 'City',
                            'sub-pages' => [
                                [
                                    'title' => 'Dashboard',
                                    'url' => '/console/dashboard',
                                    'colour' => 'red',
                                ],[
                                    'title' => 'Map',
                                    'url' => '/console/map/dashboard',
                                    'colour' => 'red',
                                ],[
                                    'title' => 'Places',
                                    'url' => '/console/places',
                                    'colour' => 'red',
                                ],[
                                    'title' => 'Roads',
                                    'url' => '/console/roads',
                                    'colour' => 'red',
                                ],[
                                    'title' => 'Tracks',
                                    'url' => '/console/tracks',
                                    'colour' => 'red',
                                ],[
                                    'br' => '---',
                                ],[
                                    'title' => 'Visit Events App',
                                    'url' => 'https://events.brickmmo.com',
                                    'colour' => 'orange',
                                    'icon' => 'fa-solid fa-arrow-up-right-from-square',
                                ],[
                                    'br' => '---',
                                ],[
                                    'title' => 'Uptime Report',
                                    'url' => 'https://uptime.brickmmo.com/details/9',
                                    'colour' => 'orange',
                                    'icons' => 'bm-uptime',
                                ],[
                                    'title' => 'Stats Report',
                                    'url' => '/stas/events',
                                    'colour' => 'orange',
                                    'icons' => 'bm-stats',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    if($selected)
    {
        
        $selected = '/'.$selected;
        $selected = str_replace('//', '/', $selected);
        $selected = str_replace('.php', '', $selected);
        $selected = str_replace('.', '/', $selected);
        $selected = substr($selected, 0, strpos($selected, '/'));

        foreach($navigation as $levels)
        {

            foreach($levels['sections'] as $section)
            {

                foreach($section['pages'] as $page)
                {

                    if(strpos($page['url'], $selected) === 0)
                    {
                        return $page;
                    }

                }

            }

        }

    }

    return $navigation;

}