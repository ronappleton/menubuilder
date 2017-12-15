<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'Pages',
            'url' => 'admin/pages',
            'icon' => 'file',
            'label' => 4,
            'label_color' => 'success',
        ],
        'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'url' => 'admin/settings',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'url' => 'admin/settings',
            'icon' => 'lock',
        ],
        [
            'text' => 'Multilevel',
            'icon' => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url' => '#',
                ],
                [
                    'text' => 'Level One',
                    'url' => '#',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url' => '#',
                        ],
                        [
                            'text' => 'Level Two',
                            'url' => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url' => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url' => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url' => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text' => 'Important',
            'icon_color' => 'red',
        ],
        [
            'text' => 'Warning',
            'icon_color' => 'yellow',
        ],
        [
            'text' => 'Information',
            'icon_color' => 'aqua',
        ],
    ],

    'views' => [
        'layouts.admin.sidebars.left',

    ],

    'classes' => [

        'active' => 'menu-builder.classes.bootstrap.4', //Tells menu-item.blade.php which of below to use

        'bootstrap' => [
            "3" => [
                'outer.ul' => '',
                'item' => '',
                'link' => '',
            ],
            "4" => [
                'outer.ul' => 'nav nav-pills flex-column',

                'item' => 'nav-item',
                'link' => 'nac-link',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        RonAppleton\MenuBuilder\Menu\Filters\HrefFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\ActiveFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\SubmenuFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\ClassesFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\GateFilter::class,
    ],

];
