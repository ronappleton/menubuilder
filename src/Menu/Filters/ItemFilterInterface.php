<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;

interface ItemFilterInterface
{
    public function transform($item, Builder $builder);
}
