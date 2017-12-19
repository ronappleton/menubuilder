<?php

namespace RonAppleton\MenuBuilder\Abstracts;

use Illuminate\Support\ServiceProvider;
use RonAppleton\MenuBuilder\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;

class AbstractMenuBuilder extends ServiceProvider
{
    public function boot(Dispatcher $events)
    {
        $this->menuListener($events);
    }

    public function menuListener($events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $menuItems = $this->getMenu($event->menuName);

            if (!is_array($menuItems)) {
                return;
            }

            foreach ($menuItems as $menuItem) {
                $event->menu->add($menuItem);
            }
        });
    }

    private function getMenu($menuName)
    {
        $method = 'menu' . $menuName;

        if (method_exists($this, $method)) {
            return $this->$method();
        }

    }
}