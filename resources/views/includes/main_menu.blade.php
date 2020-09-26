<li>
    <a class="nav-link menu-title {{ Route::currentRouteName()=='index' ? 'active' : '' }}" href="{{route('index')}}"><i data-feather="home"></i><span>Dashboard</span></a>
</li>

<li class="dropdown">
    <a class="nav-link menu-title  {{request()->route()->getPrefix() == '/settings' ? 'active' : '' }}" href="javascript:void(0)"><i data-feather="file-text"></i><span>Settings</span>
        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/settings' ? 'down' : 'right' }}"></i></div>
    </a>

    <ul class="nav-submenu menu-content" style="display: {{request()->route()->getPrefix() == '/settings' ? 'block;' : 'none;' }}">
        <li ><a class="{{ Route::currentRouteName()=='basicSettings' ? 'active' : '' }}" href="{{route('basicSettings')}}">Website Settings</a></li>
        <li>
            <a class="submenu-title {{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.edit']) ? 'active' : '' }}" href="javascript:void(0)">User
                <div class="according-menu"><i class="fa fa-angle-{{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.edit']) ? 'down' : 'right' }}"></i></div>
            </a>
            <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.edit']) ? 'block;' : 'none;' }}">
                <li><a href="{{route('user.index')}}" class="{{ Route::currentRouteName()=='user.index' ? 'active' : '' }}">User List</a></li>
                <li><a href="{{route('user.create')}}" class="{{ Route::currentRouteName()=='user.create' ? 'active' : '' }}">Create User</a></li>
            </ul>
        </li>
    </ul>
</li>
