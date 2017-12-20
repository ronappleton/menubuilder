# MenuBuilder for Laravel 5.5 Upwards

## Credit

MenuBuilder is taken from the jeroennoten/Laravel-AdminLTE package by Jeroen Noten, the premise of this MenuBuilder is fantastic, which is why I wanted to use it as the base for a better menu system that integrates with Laravel with ease.

## About MenuBuilder

MenuBuilder is a package for building menus with your Laravel Applications, with it you can create as many menus as you want, and use them wherever you want, even create you navbar menus using it.

### Installation

Installing MenuBuilder is easy, simply:

        composer require ronappleton/menubuilder "dev-master"
        
Laravel will discover the package and make it usable.

The next step is to publish the config file and the views (the only view you need is the menu-item.blade.php, but it comes with some examples)

        php artisan vendor:publish
        
and choose RonAppleton/MenuBuilder from the list given.

### Example Usage

To use it straight away, there is an example menu already defined within the menu-builder.php config file in your config folder.

The example menu is called example-sidebar, to add this to a view and see MenuBuilder in action, simply add one of your views to the views array in the menu-builder.php config file, then add:

        @each('menu-builder::partials.menu-item',
        $menuBuilder->menu('sidebar'), 'item',
        ['menuBuilder' => $menuBuilder])
        
to the view just added to the view file.

### Features

MenuBuilder expands heavily on the work of the original. Along with Item filters, there is now the ability to run filters on the menu itself, just prior to returning the data to the view.

You Can:
1. Create Headers
2. Create Menu Entries
3. Create Dropdown Menus
4. Add Icons
5. Add Badges
6. Set default menu text color
7. Set menu Header, Entry, Dropdown text color
8. Control menu item visibilty based on permissions
9. Specify route or url and will translate to Laravel
10. Define menus within your module service providers
11. Define menus in config file
12. Use Trait to allow defining menus anywhere
13. Get badge values from models
14. Control badge colors using multiple conditions
15. Add custom filters to extend functionality
16. Use 12 preset priorities to control menu item positioning
17. Do more..
18. Expect more..

MenuBuilder has been re-thought to give a lot more control, and there is so much further it can go too.

## Defining Menus

As said there is currently two ways of defining you menus, in the config file for MenuBuilder and in your module service providers.

First we will look at the structure that defines the menus in both.

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
    
NOTE: The first item in the example above sets the default text colour for the menu:
    
        'example-menu-default-text-color' => 'secondary',

At present, that can only be done via the MenuBuilder config file.

You can see just by reading through, most of the available options for controlling your menus, you can also see the usage of a class to control the badge, this is simply the full namespace and class name of the class you want the filter (BadgeItemFilter) to call and the method within that class to call.

    'badge_model' => 'RonAppleton\MenuBuilder\Models\BadgeExample',
    'badge_method' => 'totalUsers',

One thing missing from the example above is controlling the visibility of a menu item using the 'can' attribute, this uses Laravels gate for seeing if the current user has the specified permission and hides the menu option if not. 

Note: In no way does MenuBuilder prevent access to anything, it only prevents the user from seeing an option within the menu.

### Module Service Providers (and application providers)

MenuBuilder now has a Trait called AddsMenu, to enable a service provider to create a menu, simple add the class, and a use statement for:

    use Illuminate\Contracts\Events\Dispatcher;
    
and in the boot method add the Dispatcher and call:

    $this->menuListener($events);
    
and your service provider is now ready to serve menus.

When hearing a building menu event, the name of the menu being requested is passed along, so your provider is aware of which menu is being built.

NOTE: Your menu names must be camelCased within your service providers to be found, but if calling menu from the config, snake_casing etc can be used, it is advisable to use camelCasing in both cases to avoid confusion.

To define the menu within your provider simple prefix the word menu to a method with your menu name. So for example if your menu name is:

    SidebarMenu
    
then the method within your service provider serving the menu should be called:

    menuSidebarMenu()
    
This method should return an array of arrays. To build the above menu from your service provider use:

    private function menuSideBar() {
        return [
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
        ];
    }
    
Now when the view calling for the SidebarMenu makes its call, the service provider, using the Trait will hear the event, and return the correct menu for you.

NOTE: If the menu is defined in the service provider and the config file, it will duplicate. If the menu is in your own modules service provider, dont add it to the config file, however using the priorities, you can define in the provider and add extra entries in the config file and use priorities to ensure the menus display correctly, thus allowing you to tailor the menu to the application you are working on without altering your module code.