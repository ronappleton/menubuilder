<?php

namespace RonAppleton\MenuBuilder\Menu;

class Builder
{
    const HIGHEST_PRIORITY = 'highest';
    const HIGH_PRIORITY = 'high';
    const MEDIUM_HIGH_PRIORITY = 'medium-high';
    const LOW_HIGH_PRIORITY = 'low-high';

    const HIGHEST_MEDIUM_PRIORITY = 'highest-medium';
    const HIGH_MEDIUM_PRIORITY = 'high-medium';
    const MEDIUM_PRIORITY = 'medium';
    const LOW_MEDIUM_PRIORITY = 'low-medium';

    const HIGHEST_LOW_PRIORITY = 'highest-low';
    const HIGH_LOW_PRIORITY = 'high-low';
    const MEDIUM_LOW_PRIORITY = 'medium-low';
    const LOW_PRIORITY = 'low';

    private $priorityOrder = [];

    public $menu = [];

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

            if(!isset($item['priority']))
            {
                $this->priorityOrder[11][] = $item;
                continue;
            }

            if(isset($item['priority']))
            {
                switch($item['priority'])
                {
                    case self::HIGHEST_PRIORITY:
                        $this->priorityOrder[0][] = $item;
                        break;
                    case self::HIGH_PRIORITY:
                        $this->priorityOrder[1][] = $item;
                        break;
                    case self::MEDIUM_HIGH_PRIORITY:
                        $this->priorityOrder[2][] = $item;
                        break;
                    case self::LOW_HIGH_PRIORITY:
                        $this->priorityOrder[3][] = $item;
                        break;
                    case self::HIGHEST_MEDIUM_PRIORITY:
                        $this->priorityOrder[4][] = $item;
                        break;
                    case self::HIGH_MEDIUM_PRIORITY:
                        $this->priorityOrder[5][] = $item;
                        break;
                    case self::MEDIUM_PRIORITY:
                        $this->priorityOrder[6][] = $item;
                        break;
                    case self::LOW_MEDIUM_PRIORITY:
                        $this->priorityOrder[6][] = $item;
                        break;
                    case self::HIGHEST_LOW_PRIORITY:
                        $this->priorityOrder[7][] = $item;
                        break;
                    case self::HIGH_LOW_PRIORITY:
                        $this->priorityOrder[8][] = $item;
                        break;
                    case self::MEDIUM_LOW_PRIORITY:
                        $this->priorityOrder[9][] = $item;
                        break;
                    default:
                        $this->priorityOrder[11][] = $item;
                }
            }
        }
    }

    public function populateMenu()
    {
        ksort($this->priorityOrder);

        foreach($this->priorityOrder as $priorityOrderArray)
        {
            foreach($priorityOrderArray as $item)
            {
                array_push($this->menu, $item);
            }
        }
    }

    private function defaultTextColor($item)
    {
        if(isset($item['text_color']))
        {
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