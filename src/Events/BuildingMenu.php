<?php

namespace RonAppleton\MenuBuilder\Events;

use RonAppleton\MenuBuilder\Menu\Builder;

class BuildingMenu
{
    public $menu;

    public function __construct(Builder $menu)
    {
        $this->menu = $menu;
    }
}
