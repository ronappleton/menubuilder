@inject('menuBuilder', 'RonAppleton\MenuBuilder\MenuBuilder')

@if (is_string($item))
    <li class="header">{{ $item }}</li>
@else
    <?php if(isset($item['submenu'])) { ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbar{{ $item['text'] }}" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $item['text'] }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbar{{ $item['text'] }}">
            @each('menu-builder::partials.menu-item', $item['submenu'], 'item')
        </div>
    </li>
    <?php } else { ?>
    {!! $item['dropped'] ? '' : '<li class="nav-item">' !!}
    <a class="{{ $item['dropped'] ? 'dropdown-item' : 'nav-link' }}" href="{{ $item['href'] }}" target="{{ empty($item['target']) ? '' : $item['target'] }}">
        {!! empty($item['icon']) ? $item['text'] : '<i class="fa fa-fw fa-' . $item['icon']. '"></i>' . $item['text'] !!}
        <?php if(!empty($item['label'])) { ?>
        <span class="pull-right-container">
                    <?php if(!empty($item['label_color'])) {?>
            <span class="label label-{{ $item['label_color'] }} pull-right">
                    <?php } else { ?>
                <span class="label pull-right">
                        {!! $item['label'] !!}
                    </span>
                <?php } ?>
                        </span>
        <?php } ?>
    </a>
    {!! $item['dropped'] ? '' : '</li>' !!}
    <?php } ?>
@endif