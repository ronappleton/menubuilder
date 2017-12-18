<?php

namespace RonAppleton\MenuBuilder;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use RonAppleton\MenuBuilder\Events\BuildingSidebar;
use RonAppleton\MenuBuilder\Events\BuildingNavbarLeft;
use RonAppleton\MenuBuilder\Events\BuildingNavbarRight;
use RonAppleton\MenuBuilder\Events\BuildingNavbarMiddle;
use RonAppleton\MenuBuilder\Http\ViewComposers\MenuBuilderComposer;

class ModuleServiceProvider extends ServiceProvider
{
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

    public function boot(Factory $view, Dispatcher $events, Repository $config)
    {
        $this->loadViews();

        $this->publishConfig();

        static::eventsListen($events, $config);

        $this->registerViewComposers($view, $this->app);
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

        $this->mergeConfigFrom($configPath, 'menu-builder');
    }

    private function packagePath($path)
    {
        return __DIR__ . "/../$path";
    }

    private function registerViewComposers(Factory $view, Container $app)
    {
        $viewArray = $app['config']['menu-builder.views'];

        $view->composer($viewArray, MenuBuilderComposer::class);
    }

    public static function eventsListen(Dispatcher $events, Repository $config)
    {
        $events->listen(BuildingSidebar::class, function (BuildingSidebar $event) use ($config) {
            $menu = $config->get('menu-builder.sidebar-menu');
            self::registerMenu($event, $menu);
        });

        $events->listen(BuildingNavbarLeft::class, function (BuildingNavbarLeft $event) use ($config) {
            $menu = $config->get('menu-builder.navbar-left-menu');
            self::registerMenu($event, $menu);
        });

        $events->listen(BuildingNavbarRight::class, function (BuildingNavbarRight $event) use ($config) {
            $menu = $config->get('menu-builder.navbar-right-menu');
            self::registerMenu($event, $menu);
        });

        $events->listen(BuildingNavbarMiddle::class, function (BuildingNavbarMiddle $event) use ($config) {
            $menu = $config->get('menu-builder.navbar-middle-menu');
            self::registerMenu($event, $menu);
        });
    }

    private static function registerMenu($event, $menu)
    {
        if (!empty($menu)) {
            call_user_func_array([$event->menu, 'add'], $menu);
        }
    }
}