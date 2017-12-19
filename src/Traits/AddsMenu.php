<?php

namespace RonAppleton\MenuBuilder\Traits;

use RonAppleton\MenuBuilder\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;

trait AddsMenu
{
    public function menuListener(Dispatcher $events)
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