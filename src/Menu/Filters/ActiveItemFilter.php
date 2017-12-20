<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;
use RonAppleton\MenuBuilder\Menu\ActiveChecker;

class ActiveItemFilter implements ItemFilterInterface
{
    private $activeChecker;

    public function __construct(ActiveChecker $activeChecker)
    {
        $this->activeChecker = $activeChecker;
    }

    public function transform($item, Builder $builder)
    {
        if (! isset($item['header'])) {
            $item['active'] = $this->activeChecker->isActive($item);
        }

        return $item;
    }
}
