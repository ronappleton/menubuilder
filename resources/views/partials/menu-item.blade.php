@if (isset($item['header']))
    <li class="{{ $item['class'] }}">{{ $item['header'] }}</li>
@else
    @if(isset($item['submenu']))
        <li class="nav-item dropdown">
            @if(isset($item['text_color']))
                <a class="nav-link dropdown-toggle text-{{ $item['text_color'] }}" href="#"
                   id="navbar{{ $item['text'] }}" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="{{ $item['class'] }}"> {{ $item['text'] }}</span>
                </a>
            @else
                <a class="nav-link dropdown-toggle" href="#" id="navbar{{ $item['text'] }}" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(isset($item['icon_class']))
                        <i class="{{ $item['icon_class'] }}"></i>
                    @endif
                    {{ $item['text'] }}
                </a>
            @endif
            <div class="dropdown-menu" aria-labelledby="navbar{{ $item['text'] }}">
                @each('menu-builder::partials.menu-item', $item['submenu'], 'item')
            </div>

        </li>
    @else
        @if(!in_array('dropped', $item))
            <li class="nav-item">
                @endif
                <a class="{{ $item['class'] }}" href="{{ $item['href'] }}">
                    @if(isset($item['icon_class']))
                        <i class="{{ $item['icon_class'] }}"></i>
                    @endif
                    {{ $item['text'] }}
                    @if(isset($item['badge_class']))
                        <span class="{{ $item['badge_class'] }}">{{ $item['badge_value'] }}</span>
                    @endif
                </a>
                @if(!in_array('dropped', $item))
            </li>
        @endif
    @endif
@endif