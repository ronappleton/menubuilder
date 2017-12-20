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

    private function defaultTextColor($item)
    {
        if (isset($item['text_color'])) {
            return $item;
        }

        $item['text_color'] = config("menu-builder.{$this->menuName}-default-text-color");

        return $item;
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

        $item = $this->defaultTextColor($item);

        foreach ($this->itemFilters as $filter) {
            $item = $filter->transform($item, $this);
        }

        if (isset($item['header'])) {
            $item = $item['header'];
        }

        return $item;
    }

    public function transformMenu($menu)
    {
        return array_filter(array_map([$this, 'applyMenuFilters'], $menu));
    }

    protected function applyMenuFilters($menu)
    {
        foreach ($this->menuFilters as $filter) {
            $menu = $filter->transform($menu);
        }

        return $menu;
    }
}