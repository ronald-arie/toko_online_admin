@php
$menus = \App\Helpers\MenuHelper::generateMenu();
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @foreach ($menus as $menu)
        <li class="nav-item has-treeview {{ @$menu['menu-open'] }}">
            <a href="{{ @$menu['url'] }}" class="nav-link {{ @$menu['menu-active'] }}">
                <i class="nav-icon fa fa-{{ $menu['icon'] }}"></i>
                <p>
                    {{ $menu['text'] }}
                    @if(isset($menu['submenu']))
                    <i class="right fas fa-angle-left"></i>
                    @endif
                </p>
            </a>
            @if(isset($menu['submenu']))
            <ul class="nav nav-treeview">
                @foreach ($menu['submenu'] as $submenu)
                <li class="nav-item">
                    <a href="/{{ @$submenu['url'] }}" class="nav-link  {{ @$submenu['menu-active'] }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $submenu['text'] }}</p>
                    </a>
                </li>
                @endforeach

            </ul>
            @endif
        </li>
        @endforeach

    </ul>
</nav>
