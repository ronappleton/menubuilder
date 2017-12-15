<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;

interface FilterInterface
{
    public function transform($item, Builder $builder);
}
