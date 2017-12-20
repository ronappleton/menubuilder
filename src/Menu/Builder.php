<?php

namespace RonAppleton\MenuBuilder\Menu;

use RonAppleton\MenuBuilder\Menu\Filters\PriorityFilter;

class Builder
{
    private $menu = [];

    public $menuName;

    /**
     * @var array
     */
    private $itemFilters;

    /**
     * @var array
     */
    private $menuFilters;

    public function __construct(array $itemFilters = [], array $menuFilters = [], $menuName)
    {
        $this->itemFilters = $itemFilters;
        $this->menuFilters = $menuFilters;
        $this->menuName = $menuName;
    }

    public function add()
    {
        $items = $this->transformItems(func_get_args());

        foreach ($items as $item) {
            array_push($this->menu, $item);
        }
    }

    public function getMenu()
    {
        return $this->transformMenu($this->menu);
    }

    public function transformItems($items)
    {
        return array_filter(array_map([$this, 'applyItemFilters'], $items));
    }

    protected function applyItemFilters($item)
    {
        if (is_string($item)) {
            return $item;
        }

        foreach ($this->itemFilters as $filter) {
            $item = $filter->transform($item, $this);
        }

        return $item;
    }

    public function transformMenu($menu)
    {
        return $this->applyMenuFilters($menu);
    }

    protected function applyMenuFilters($menu)
    {
        foreach ($this->menuFilters as $filter) {
            $menu = $filter->transform($menu);
        }

        return $menu;
    }
}