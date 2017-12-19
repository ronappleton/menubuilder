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

    'sidebar-background-color' => 'bg-inverse',
    'sidebar-text-color' => 'text-white',

    'sidebar-menu' => [
        [
            'text' => 'Pages',
            'text_color' => 'success',
            'url' => 'admin/pages',
            'icon' => 'file',
            'icon_color' => 'success',
            'badge_model' => 'App\User',
            'badge_method' => 'totalUsers',
            'badge_pill',
            'badge_color' => 'danger',
            'badge_conditions' => [
                [
                    'condition' => '>',
                    'value' => 1,
                    'continue' => true,
                ],
                [
                    'condition' => '<',
                    'value' => 3,
                    'continue' => false,
                ],
                [
                    'condition' => '===',
                    'value' => 2,
                    'color' => 'warning',
                ],
                'true_color' => 'success',
                'false_color' => 'danger',
            ],
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
            'text' => 'Dropdown',
            'icon' => 'share',
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
        'LABELS',
        [
            'text' => 'Important',
            'icon' => 'lock',
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

    'navbar-left-menu' => [

    ],

    'navbar-right-menu' => [

    ],

    'navbar-middle-menu' => [

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
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        RonAppleton\MenuBuilder\Menu\Filters\IconFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\HrefFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\BadgeFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\ActiveFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\SubmenuFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\ClassesFilter::class,
        RonAppleton\MenuBuilder\Menu\Filters\GateFilter::class,
    ],

];