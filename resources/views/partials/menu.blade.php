@section('sideMenu')
    <ul class='nav nav-pills flex-column'>
        @each('menu-builder::partials.menu-item', $menuBuilder->menu(), 'item')
    </ul>
@endsection