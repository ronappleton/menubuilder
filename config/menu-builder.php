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

    /**
     * Available Bootstrap 4 Colors (https://getbootstrap.com/docs/4.0/utilities/colors/)
     *
     * primary
     *
     * secondary
     *
     * success
     *
     * danger
     *
     * warning
     *
     * info
     *
     * light
     *
     * dark
     *
     * muted
     *
     * white
     */

    'example-menu-default-text-color' => 'secondary',
    'example-menu' => [
        [
            'header' => 'Communication',
            'priority' => 'high'
        ],
        [
            'priority' => 'high',
            'text' => 'Messages',
            'icon' => 'commenting-o',
            'badge_model' => 'RonAppleton\MenuBuilder\Models\BadgeExample',
            'badge_method' => 'unreadMessages',
            'badge_conditions' => [
                [
                    'condition' => '===',
                    'value' => 0,
                    'color' => 'success',
                ],
                [
                    'condition' => '<',
                    'value' => 0,
                    'color' => 'info',
                ],
                [
                    'condition' => '>',
                    'value' => 20,
                    'color' => 'warning',
                ],
                [
                    'condition' => '>',
                    'value' => 100,
                    'color' => 'warning',
                ],
                'true_color' => 'success',
                'false_color' => 'danger',
            ]
        ],
        [
            'priority' => 'high',
            'text' => 'Email',
            'icon' => 'envelope-o',
            'badge_model' => 'RonAppleton\MenuBuilder\Models\BadgeExample',
            'badge_method' => 'unreadEmails',
            'badge_conditions' => [
                [
                    'condition' => '===',
                    'value' => 0,
                    'color' => 'success',
                ],
                [
                    'condition' => '>',
                    'value' => 0,
                    'color' => 'info',
                ],
                'true_color' => 'success',
                'false_color' => 'danger',
            ]
        ],
        [
            'priority' => 'high',
            'text' => 'Users',
            'url' => 'admin/pages',
            'icon' => 'users',
            'badge_model' => 'RonAppleton\MenuBuilder\Models\BadgeExample',
            'badge_method' => 'totalUsers',
            'badge_pill',
            'badge_color' => 'success',
        ],
        [
            'header' => 'Account Settings',
        ],
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
            'header' => 'Configuration',
        ],
        [
            'text' => 'General',
            'icon' => 'tasks',
            'priority' => 'low',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'dropped',
                    'icon' => 'lock',
                    'icon_color' => 'success',

                    'url' => '#',
                ],
                [
                    'text' => 'Level One',
                    'dropped',
                    'url' => '#',
                ],
                [
                    'text' => 'Level One',
                    'dropped',
                    'url' => '#',
                ],
            ],
        ],
        [
            'text' => 'Editing',
            'icon' => 'pencil',
            'priority' => 'low',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'dropped',
                    'icon' => 'lock',
                    'icon_color' => 'success',

                    'url' => '#',
                ],
                [
                    'text' => 'Level One',
                    'dropped',
                    'url' => '#',
                ],
                [
                    'text' => 'Level One',
                    'dropped',
                    'url' => '#',
                ],
            ],
        ],
    ],

    'views' => [
        'menu-builder::layouts.admin.sidebar.left',
        'menu-builder::layouts.admin.navbar.menus.left',
        'menu-builder::layouts.admin.navbar.menus.right',
        'menu-builder::layouts.admin.navbar.menus.middle',
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to these arrays after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'itemFilters' => [
        RonAppleton\MenuBuilder\Menu\Filters\IconItemFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\HrefItemFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\BadgeItemFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\ActiveItemFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\SubmenuItemFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\TextColorItemFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\ClassesItemFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\GateItemFilter::class,
    ],

    /*
     * Note that menu filters are run on return of the menu, after all item filters have
     * run and immediately before return.
     */

    'menuFilters' => [
        RonAppleton\MenuBuilder\Menu\Filters\PriorityFilter::class,
    ]

];