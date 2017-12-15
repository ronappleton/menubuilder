<?php

namespace RonAppleton\MenuBuilder;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use RonAppleton\MenuBuilder\Events\BuildingMenu;
use RonAppleton\Http\ViewComposers\MenuBuilderComposer;

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

    public function boot(Factory $view,Dispatcher $events, Repository $config)
    {
        $this->loadViews();

        $this->publishConfig();

        static::registerMenu($events, $config);

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
        $view->composer($app['config']['menu-builder.views'], MenuBuilderComposer::class);
    }

    public static function registerMenu(Dispatcher $events, Repository $config)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
            $menu = $config->get('menu-builder.menu');
            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}