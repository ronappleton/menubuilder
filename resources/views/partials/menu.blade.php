@section('sideMenu')
    <ul class='{{ $menuBuilder->classes()['outer.ul'] }}' data-widget='tree'>
        @each('menu-builder::partials.menu-item', $menuBuilder->menu(), 'item')
    </ul>
    <script>
        $('ul').tree()
    </script>
@endsection