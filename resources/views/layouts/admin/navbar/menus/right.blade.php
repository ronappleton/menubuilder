<ul class='nav nav-pills flex-column'>
    @if($buildMenu = $menuBuilder->menu('navbar-right'))
        @each('menu-builder::partials.menu-item', $buildMenu, 'item', ['menuBuilder' => $menuBuilder])
    @endif
</ul>