<div class="container-fluid h-100">
    <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down  sidebar {{ config('menu-builder.sidebar-text-color') }} h-100">
            <ul class='nav nav-pills flex-column h-100 {{ 'bg-' . config('menu-builder.sidebar-background-color') }}'>
                @if($buildMenu = $menuBuilder->menu('sidebar'))
                    @each('menu-builder::partials.menu-item', $buildMenu, 'item', ['menuBuilder' => $menuBuilder])
                @endif
            </ul>
        </nav>