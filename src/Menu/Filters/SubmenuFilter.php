<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;

class SubmenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['submenu'])) {
            $item['submenu'] = $builder->transformItems($item['submenu']);
            $item['submenu_open'] = $item['active'];
            $item['submenu_classes'] = $this->makeSubmenuClasses();
            $item['submenu_class'] = implode(' ', $item['submenu_classes']);
        }

        return $item;
    }

    protected function makeSubmenuClasses()
    {
        $active = config('menu-builder.classes.active');
        
        $classes = ['treeview-menu', config($active)['submenu']];

        return $classes;
    }
}
