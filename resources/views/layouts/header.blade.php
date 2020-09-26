<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper"><a href="{{route('index')}}"><img class="img-fluid" src="
    @if(!empty($settings['logo']))
                  {{asset('/storage/image/'.$settings['logo'])}}
              @else
                  {{asset('/storage/default/logo.png')}} @endif" width="30" alt="{{$settings['website_title']}}"></a></div>
    </div>
    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"></i></div>

    <div class="nav-right col pull-right right-menu">
      <ul class="nav-menus">
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="onhover-dropdown p-0">
          <div class="media profile-media">
            <img class="b-r-10" style="width: 37px; height: 37px" src="{{asset('/storage/image/'.Auth::user()->image)}}">
            <div class="media-body">
              <span>{{Auth::user()->name}}</span>
              <p class="mb-0 font-roboto">{{Auth::user()->position}} <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li><i data-feather="user"></i><a class="header-anchor" href="{{route('profile')}}">Account</a></li>
            <li><i data-feather="anchor"></i><a class="header-anchor" href="{{route('passwordChange')}}"><span>Change Password</span></a></li>
              <li> <i data-feather="log-out"></i>
                  <a class="header-anchor" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
  </div>
</div>
