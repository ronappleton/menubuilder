<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;


use RonAppleton\MenuBuilder\Menu\Builder;

class TextColorItemFilter implements ItemFilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['text_color'])) {
            return $item;
        }

        $item['text_color'] = config("menu-builder.{$builder->menuName}-default-text-color");

        return $item;
    }
}