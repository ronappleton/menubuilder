<?php

namespace RonAppleton\MenuBuilder\Menu\Filters;

use RonAppleton\MenuBuilder\Menu\Builder;
use Illuminate\Contracts\Routing\UrlGenerator;

class HrefItemFilter implements ItemFilterInterface
{
    protected $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function transform($item, Builder $builder)
    {
        $item['href'] = $this->makeHref($item);

        return $item;
    }

    protected function makeHref($item)
    {
        if (isset($item['url'])) {
            return $this->urlGenerator->to($item['url']);
        }

        if (isset($item['route'])) {
            return $this->urlGenerator->route($item['route']);
        }

        return '#';
    }
}
