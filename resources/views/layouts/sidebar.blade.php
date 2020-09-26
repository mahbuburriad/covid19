<header
    @if(Auth::user()->theme == 'compact' || Auth::user()->theme == 'compact_rtl' || Auth::user()->theme == 'compact_dark')
    class="main-nav close_icon"
    @elseif(empty(Auth::user()->theme))
    class="main-nav"
    @else
    class="main-nav"
    @endif
>
    <div class="logo-wrapper"><a href="{{route('index')}}"><img class="img-fluid" src="
@if(!empty($settings['logo']))
            {{asset('/storage/image/'.$settings['logo'])}}
            @else
            {{asset('/storage/default/logo.png')}} @endif" alt=""></a> </div>
    <div class="logo-icon-wrapper"><a href="{{route('index')}}"><img class="img-fluid" src="
@if(!empty($settings['favicon']))
            {{asset('/storage/image/'.$settings['favicon'])}}
            @else
            {{asset('/storage/default/logo.png')}} @endif" alt=""></a></div>
    <nav>
      <div class="main-navbar">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="mainnav">
          <ul class="nav-menu custom-scrollbar">
            <li class="back-btn">
              <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
            </li>
              @include('includes.main_menu')
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </div>
    </nav>
</header>
