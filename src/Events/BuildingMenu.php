<?php

namespace RonAppleton\MenuBuilder\Events;

use RonAppleton\MenuBuilder\Menu\Builder;

class BuildingMenu
{
    public $menu;

    public $menuName;

    public function __construct(Builder $menu, $menuName)
    {
        $this->menu = $menu;
        $this->menuName = $menuName;
    }
}