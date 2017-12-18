<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;

class ClassesFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (! isset($item['header'])) {
            $item['classes'] = $this->makeClasses($item);
            $item['class'] = implode(' ', $item['classes']);
        }

        return $item;
    }

    protected function makeClasses($item)
    {
        $classes = [];

        if ($item['active']) {
            $classes[] = 'active';
        }

        if (isset($item['submenu'])) {
            $classes[] = 'dropdown';
        }

        if (in_array('dropped', $item)){
            $classes[] = 'dropdown-item';
        }
        else {
            $classes[] = 'nav-link';
        }

        return $classes;
    }
}
