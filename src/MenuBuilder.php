<?php

namespace RonAppleton\MenuBuilder;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use RonAppleton\MenuBuilder\Events\BuildingNavbarLeft;
use RonAppleton\MenuBuilder\Events\BuildingNavbarMiddle;
use RonAppleton\MenuBuilder\Events\BuildingNavbarRight;
use RonAppleton\MenuBuilder\Events\BuildingSidebar;
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

    public function menu($toBuild = 'sidebar')
    {
        if (!$this->menuName == $toBuild) {
            $this->menu = $this->buildMenu($toBuild);
        }

        return $this->menu;
    }

    protected function buildMenu($toBuild)
    {
        $builder = new Builder($this->buildFilters());

        switch ($toBuild) {
            case 'sidebar':
                $this->events->fire(new BuildingSidebar($builder));
                break;
            case 'navbar-left':
                $this->events->fire(new BuildingNavbarLeft($builder));
                break;
            case 'navbar-right':
                $this->events->fire(new BuildingNavbarRight($builder));
                break;
            case 'navbar-middle':
                $this->events->fire(new BuildingNavbarMiddle($builder));
                break;
            default:
                $this->events->fire(new BuildingSidebar($builder));
        }


        return $builder->menu;
    }

    protected function buildFilters()
    {
        return array_map([$this->container, 'make'], $this->filters);
    }
}