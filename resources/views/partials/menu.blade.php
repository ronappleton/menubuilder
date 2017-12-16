@section('sideMenu')
    <ul class='sidebar-menu {{ $menuBuilder->classes()['outer.ul'] }}' data-widget='tree'>
        @each('menu-builder::partials.menu-item', $menuBuilder->menu(), 'item')
    </ul>
    <script>
        $('ul').tree()
    </script>
@endsection