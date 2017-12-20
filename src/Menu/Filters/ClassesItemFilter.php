<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;

class ClassesItemFilter implements ItemFilterInterface
{
    public function transform($item, Builder $builder)
    {
        $item['classes'] = $this->makeClasses($item);
        $item['class'] = implode(' ', $item['classes']);

        return $item;
    }

    protected function makeClasses($item)
    {
        $classes = [];

        if(isset($item['header']))
        {
            $classes[] = 'header';
        }

        if ($item['active']) {
            $classes[] = 'active';
        }

        if (isset($item['submenu'])) {
            $classes[] = 'dropdown';
        }

        if(!isset($item['header']))
        {
            $classes[] = in_array('dropped', $item) ? 'dropdown-item' : 'nav-link';
        }

        if(isset($item['text_color']))
        {
            $classes[] = "text-{$item['text_color']}";
        }

        if(isset($item['bg_color']))
        {
            $classes[] = "gb-{$item['bg_color']}";
        }

        return $classes;
    }
}
