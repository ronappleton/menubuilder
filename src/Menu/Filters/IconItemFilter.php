<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;

class IconItemFilter implements ItemFilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (!isset($item['header']) && isset($item['icon'])) {
            $item['icon_class'] = $this->makeIconClass($item);
        }

        return $item;
    }

    private function makeIconClass($item)
    {
        $iconColor = isset($item['icon_color']) ? ' text-' . $item['icon_color'] : '';

        return "fa fa-fw fa-{$item['icon']}{$iconColor}";
    }
}