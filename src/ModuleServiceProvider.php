<?php

namespace RonAppleton\MenuBuilder;

use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use RonAppleton\MenuBuilder\Events\BuildingMenu;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(Dispatcher $events, Repository $config)
    {
        $this->loadViews();

        $this->publishConfig();

        $this->registerDirectives();

        static::registerMenu($events, $config);
    }

    public function register()
    {
        $this->app->singleton(MenuBuilder::class, function (Container $app) {
            return new MenuBuilder(
                $app['config']['menu-builder.filters'],
                $app['events'],
                $app
            );
        });
    }

    private function loadViews()
    {
        $viewsPath = $this->packagePath('resources/views');

        $this->loadViewsFrom($viewsPath, 'menu-builder');

        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/menu-builder'),
        ], 'views');
    }

    private function publishConfig()
    {
        $configPath = $this->packagePath('config/menu-builder.php');

        $this->publishes([
            $configPath => config_path('menu-builder.php'),
        ], 'config');

        $this->mergeConfigFrom($configPath, 'menubuilder');
    }

    private function packagePath($path)
    {
        return __DIR__ . "/../$path";
    }

    private function registerDirectives()
    {

        Blade::directive('sidebarMenu', function (MenuBuilder $menuBuilder) {
            return "
            <ul class='sidebar-menu' data-widget='tree'>
        @each('menu-builder::partials.menu-item', $menuBuilder->menu(), 'item')
                </ul>
            ";
        });

        Blade::directive('topNavMenu', function (MenuBuilder $menuBuilder) {
            return "
            <div class='collapse navbar-collapse pull-left' id='navbar-collapse'>
                        <ul class='nav navbar-nav'>
                            @each('menu-builder::partials.menu-item-top-nav', $menuBuilder->menu(), 'item')
                        </ul>
                    </div>
            ";
        });
    }

    public static function registerMenu(Dispatcher $events, Repository $config)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
            $menu = $config->get('menu-builder.menu');
            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}