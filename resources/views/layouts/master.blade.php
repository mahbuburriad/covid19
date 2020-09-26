<!DOCTYPE html>
<html lang="en" dir={{in_array(Auth::user()->theme, ['dark_rtl', 'rtl', 'compact_rtl', 'vertical_rtl']) ? 'rtl' : 'ltr'}}>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    @if(!empty($settings['logo']))
    <link rel="icon" href="{{asset('/storage/image/'.$settings['logo'])}}" type="image/x-icon">
    @else
        <link rel="icon" href="{{asset('/storage/default/logo.png')}}" type="image/x-icon">
    @endif
    @if(!empty($settings['logo']))
        <link rel="shortcut icon" href="{{asset('/storage/image/'.$settings['favicon'])}}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{asset('/storage/default/logo.png')}}" type="image/x-icon">
    @endif
    <title>{{$settings['website_title']. ' | '}} @yield('title', 'ERP')</title>
    @include('layouts.css')
    @yield('style')
</head>
<body
    @if(Auth::user()->theme == 'light')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="ltr"
    @elseif(Auth::user()->theme == 'dark')
    class="dark-only {{Auth::user()->sidebar}}" main-theme-layout="ltr"
    @elseif(Auth::user()->theme == 'dark_rtl')
    class="dark-only {{Auth::user()->sidebar}}" main-theme-layout="rtl"
    @elseif(Auth::user()->theme == 'box')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="box-layout"
    @elseif(Auth::user()->theme == 'dark_box')
    class="dark-only {{Auth::user()->sidebar}}" main-theme-layout="box-layout"
    @elseif(Auth::user()->theme == 'rtl')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="rtl"
    @elseif(Auth::user()->theme == 'compact')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="ltr"
    @elseif(Auth::user()->theme == 'compact_rtl')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="rtl"
    @elseif(Auth::user()->theme == 'compact_dark')
    class="dark-only {{Auth::user()->sidebar}}" main-theme-layout="ltr"
    @elseif(Auth::user()->theme == 'vertical')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="ltr"
    @elseif(Auth::user()->theme == 'vertical_box')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="box-layout"
    @elseif(Auth::user()->theme == 'vertical_rtl')
    class="light-only {{Auth::user()->sidebar}}" main-theme-layout="rtl"
    @elseif(empty(Auth::user()->theme))
    class="light-only light-sidebar" main-theme-layout="ltr"
    @else
    class="light-only light-sidebar" main-theme-layout="ltr"
    @endif
>
<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="loader-index"><span></span></div>
    <svg>
        <defs></defs>
        <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11"
                            result="blur"></fegaussianblur>
            <fecolormatrix in="blur"
                           values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9"
                           result="goo"></fecolormatrix>
        </filter>
    </svg>
</div>
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div
    @if(Auth::user()->theme == 'vertical_rtl' || Auth::user()->theme == 'vertical_box' || Auth::user()->theme == 'vertical')
    class="page-wrapper horizontal-wrapper" id="pageWrapper"
    @elseif(empty(Auth::user()->theme))
    class="page-wrapper compact-wrapper" id="pageWrapper"
    @else
    class="page-wrapper compact-wrapper" id="pageWrapper"
    @endif
>
    <!-- Page Header Start-->
@include('layouts.header')
<!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div
        @if(Auth::user()->theme == 'vertical_rtl' || Auth::user()->theme == 'vertical_box' || Auth::user()->theme == 'vertical')
        class="page-body-wrapper horizontal-menu"
        @elseif(empty(Auth::user()->theme))
        class="page-body-wrapper sidebar-icon"
        @else
        class="page-body-wrapper sidebar-icon"
        @endif
    >
        <!-- Page Sidebar Start-->
    @include('layouts.sidebar')
    <!-- Page Sidebar Ends-->
        <div
            class="page-body">

            <!-- Container-fluid starts-->
        @yield('content')
        <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('layouts.footer')
    </div>
</div>
@include('layouts.script')
</body>
</html>
