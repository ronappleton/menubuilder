<?php

namespace RonAppleton\Http\ViewComposers;

use Illuminate\View\View;
use RonAppleton\MenuBuilder\MenuBuilder;

class MenuBuilderComposer
{
    /**
     * @var MenuBuilder
     */
    private $menuBuilder;

    public function __construct(
        MenuBuilder $menuBuilder
    ) {
        $this->menuBuilder = $menuBuilder;
    }

    public function compose(View $view)
    {
        $view->with('menuBuilder', $this->menuBuilder);
    }
}
