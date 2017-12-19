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
    private $filters;

    public function __construct(array $filters = [], $menuName)
    {
        $this->filters = $filters;
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
        return (new PriorityFilter)->transform($this->menu);
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
        return array_filter(array_map([$this, 'applyFilters'], $items));
    }

    protected function applyFilters($item)
    {
        if (is_string($item)) {
            return $item;
        }

        $item = $this->defaultTextColor($item);

        foreach ($this->filters as $filter) {
            $item = $filter->transform($item, $this);
        }

        if (isset($item['header'])) {
            $item = $item['header'];
        }

        return $item;
    }
}