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
    | NOTE: This addon uses bootstrap and as such, nested dropdown within dropdowns
    | are not supported by bootsrap as it is a mobile first framework.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Blog',
            'dropped' => false,
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'Pages',
            'dropped' => false,
            'url' => 'admin/pages',
            'icon' => 'file',
            'label' => 4,
            'label_color' => 'success',
        ],
        'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'dropped' => false,
            'url' => 'admin/settings',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'dropped' => false,
            'url' => 'admin/settings',
            'icon' => 'lock',
        ],
        [
            'text' => 'Dropdown',
            'dropped' => false,
            'icon' => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'dropped' => true,
                    'url' => '#',
                ],
                [
                    'text' => 'Level One',
                    'dropped' => true,
                    'url' => '#',
                ],
                [
                    'text' => 'Level One',
                    'dropped' => true,
                    'url' => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text' => 'Important',
            'dropped' => false,
            'icon_color' => 'red',
        ],
        [
            'text' => 'Warning',
            'dropped' => false,
            'icon_color' => 'yellow',
        ],
        [
            'text' => 'Information',
            'dropped' => false,
            'icon_color' => 'aqua',
        ],
    ],

    'views' => [
        'layouts.admin.sidebars.left',

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
