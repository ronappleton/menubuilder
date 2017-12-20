<?php

namespace RonAppleton\MenuBuilder;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use RonAppleton\MenuBuilder\Events\BuildingMenu;
use RonAppleton\MenuBuilder\Menu\Builder;

class MenuBuilder
{
    protected $menu;

    protected $menuName;

    protected $itemFilters;

    protected $menuFilters;

    protected $events;

    protected $container;

    public function __construct(
        array $itemFilters,
        array $menuFilters,
        Dispatcher $events,
        Container $container
    ) {
        $this->itemFilters = $itemFilters;
        $this->menuFilters = $menuFilters;
        $this->events = $events;
        $this->container = $container;
    }

    public function menu($toBuild)
    {
        if (!$this->menuName == $toBuild) {
            $this->menu = $this->buildMenu($toBuild);
        }

        return $this->menu;
    }

    protected function buildMenu($toBuild)
    {
        $builder = new Builder($this->buildItemFilters(), $this->buildMenuFilters(), $toBuild);

        $this->events->fire(new BuildingMenu($builder, $toBuild));

        return $builder->getMenu();
    }

    protected function buildItemFilters()
    {
        return array_map([$this->container, 'make'], $this->itemFilters);
    }
    protected function buildMenuFilters()
    {
        return array_map([$this->container, 'make'], $this->menuFilters);
    }

}