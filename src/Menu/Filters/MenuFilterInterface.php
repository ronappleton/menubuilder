<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;

interface MenuFilterInterface
{
    public function transform(array $menu);
}