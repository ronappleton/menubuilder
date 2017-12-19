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

    protected $filters;

    protected $events;

    protected $container;

    public function __construct(
        array $filters,
        Dispatcher $events,
        Container $container
    ) {
        $this->filters = $filters;
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
        $builder = new Builder($this->buildFilters(), $toBuild);

        $this->events->fire(new BuildingMenu($builder, $toBuild));

        $builder->populateMenu();

        return $builder->menu;
    }

    protected function buildFilters()
    {
        return array_map([$this->container, 'make'], $this->filters);
    }
}