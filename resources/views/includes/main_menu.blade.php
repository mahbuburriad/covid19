<li>
    <a class="nav-link menu-title {{ Route::currentRouteName()=='index' ? 'active' : '' }}" href="{{route('index')}}"><i data-feather="home"></i><span>Dashboard</span></a>
</li>

<li class="dropdown">
    <a class="nav-link menu-title  {{request()->route()->getPrefix() == '/data' ? 'active' : '' }}" href="javascript:void(0)"><i data-feather="file-text"></i><span>Data</span>
        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/data' ? 'down' : 'right' }}"></i></div>
    </a>

    <ul class="nav-submenu menu-content" style="display: {{request()->route()->getPrefix() == '/data' ? 'block;' : 'none;' }}">
        <li ><a class="{{ Route::currentRouteName()=='liveData' ? 'active' : '' }}" href="{{route('liveData')}}">Live</a></li>
        <li ><a class="{{ Route::currentRouteName()=='yesterdayShow' ? 'active' : '' }}" href="{{route('yesterdayShow')}}">Yesterday</a></li>
        <li ><a class="{{ Route::currentRouteName()=='vaccineData' ? 'active' : '' }}" href="{{route('vaccineData')}}">Vaccine Tracker</a></li>
        <li>
            <a class="submenu-title {{ in_array(Route::currentRouteName(), ['worldometer', 'jhpomber']) ? 'active' : '' }}" href="javascript:void(0)">Data Dictionary
                <div class="according-menu"><i class="fa fa-angle-{{ in_array(Route::currentRouteName(), ['worldometer', 'jhpomber']) ? 'down' : 'right' }}"></i></div>
            </a>
            <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['worldometer', 'jhpomber']) ? 'block;' : 'none;' }}">
                <li><a href="{{route('worldometer')}}" class="{{ Route::currentRouteName()=='worldometer' ? 'active' : '' }}">Worldometer</a></li>
                <li><a href="{{route('jhpomber')}}" class="{{ Route::currentRouteName()=='jhpomber' ? 'active' : '' }}">John Hopkins</a></li>
            </ul>
        </li>
    </ul>
</li>


<li class="dropdown">
    <a class="nav-link menu-title  {{request()->route()->getPrefix() == '/state' ? 'active' : '' }}" href="javascript:void(0)"><i data-feather="file-text"></i><span>State</span>
        <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/state' ? 'down' : 'right' }}"></i></div>
    </a>

    <ul class="nav-submenu menu-content" style="display: {{request()->route()->getPrefix() == '/state' ? 'block;' : 'none;' }}">
        <li>
            <a class="submenu-title {{ in_array(Route::currentRouteName(), ['bangladeshToday', 'bangladeshAll']) ? 'active' : '' }}" href="javascript:void(0)">Bangladesh
                <div class="according-menu"><i class="fa fa-angle-{{ in_array(Route::currentRouteName(), ['bangladeshToday', 'bangladeshAll']) ? 'down' : 'right' }}"></i></div>
            </a>
            <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['bangladeshToday', 'bangladeshAll']) ? 'block;' : 'none;' }}">
                <li><a href="{{route('bangladeshToday')}}" class="{{ Route::currentRouteName()=='bangladeshToday' ? 'active' : '' }}">Today</a></li>
                <li><a href="{{route('bangladeshAll')}}" class="{{ Route::currentRouteName()=='bangladeshAll' ? 'active' : '' }}">All</a></li>
            </ul>
        </li>
    </ul>
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
