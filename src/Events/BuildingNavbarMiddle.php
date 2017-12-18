<?php

namespace RonAppleton\MenuBuilder\Events;

use RonAppleton\MenuBuilder\Menu\Builder;

class BuildingNavbarMiddle
{
    public $menu;

    public function __construct(Builder $menu)
    {
        $this->menu = $menu;
    }
}