<style>
    .sidebar {
        min-height: calc(100vh - 58px);
    }
</style>
<nav id="sidebar" class="col-sm-3 col-md-2 hidden-xs-down sidebar bg-dark text-muted collapse show width">
    <ul class='nav nav-pills flex-column '>
        @if($buildMenu = $menuBuilder->menu('sidebar'))
            @each('menu-builder::partials.menu-item', $buildMenu, 'item', ['menuBuilder' => $menuBuilder])
        @endif
    </ul>
</nav>