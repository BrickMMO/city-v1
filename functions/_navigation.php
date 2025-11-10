<?php

function navigation_array($selected = false)
{

    $navigation = [
        [
            'title' => 'Colours',
            'sections' => [
                [
                    'title' => 'Colours',
                    'id' => 'admin-content',
                    'pages' => [
                        [
                            'icon' => 'colours',
                            'url' => '/admin/dashboard',
                            'title' => 'Colours',
                            'sub-pages' => [
                                [
                                    'title' => 'Dashboard',
                                    'url' => '/admin/dashboard',
                                    'colour' => 'red',
                                ],[
                                    'title' => 'Import Colours',
                                    'url' => '/admin/import',
                                    'colour' => 'red',
                                ],[
                                    'br' => '---',
                                ],[
                                    'title' => 'Visit Colors App',
                                    'url' => 'https://colours.brickmmo.com',
                                    'colour' => 'orange',
                                    'icon' => 'fa-solid fa-arrow-up-right-from-square',
                                ],[
                                    'br' => '---',
                                ],[
                                    'title' => 'Uptime Report',
                                    'url' => '/uptime/colours',
                                    'colour' => 'orange',
                                    'icons' => 'bm-uptime',
                                ],[
                                    'title' => 'Stats Report',
                                    'url' => '/stas/colours',
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
        $selected = substr($selected, 0, strrpos($selected, '/'));

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