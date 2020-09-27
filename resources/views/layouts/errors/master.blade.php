 <!DOCTYPE html>
<html lang="en">
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
        <title>{{$settings['website_title']. ' | '}} @yield('title', 'Covid19')</title>
		@include('layouts.errors.css')
		@yield('style')
	</head>
	<body>
		<!-- Loader starts-->
		<div class="loader-wrapper">
			<div class="loader-index"><span></span></div>
			<svg>
				<defs></defs>
				<filter id="goo">
					<fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
					<fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>
				</filter>
			</svg>
		</div>
		<!-- Loader ends-->
		<!-- page-wrapper Start-->
		@yield('content')
		<!-- latest jquery-->
		@include('layouts.errors.script')
	</body>
</html>
