<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'COVID-19 Coronavirus Pandemic')| Saltanat Global Limited</title>

    <meta name="title" content="@yield('title', 'COVID-19 Coronavirus Pandemic')| Saltanat Global Limited">
    <meta name="description" content="@yield('description', 'Live statistics and coronavirus news tracking the number of confirmed cases, recovered patients and death toll due to the COVID-19 coronavirus from Wuhan, China. Coronavirus counter with new cases, deaths, news and updates')">
    <meta name="keywords" content="covid19, coronavirus, corona virus, show corona virus information, corona virus info, corona virus status, coronavirus info, covid19 tracker, covid19 status, find covid19 data, find corona virus information, get corona virus data, get covid19 data, coronavirus update, coronavirus bangladesh, corona virus US, @yield('keywords')">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Saltanat Global Limited">

    <!--    meta tag for social media-->

    <meta property="og:title" content="@yield('title', 'COVID-19 Coronavirus Pandemic')| Saltanat Global Limited">
    <meta property="og:description" content="@yield('description', 'Live statistics and coronavirus news tracking the number of confirmed cases, recovered patients and death toll due to the COVID-19 coronavirus from Wuhan, China. Coronavirus counter with new cases, deaths, news and updates')">
    <meta property="og:url" content="{{Request::url()}}">
    <meta property="og:type" content="website">

{{--    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/images/logo.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('assets/images/logo.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/images/logo.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/images/logo.png')}}">--}}

    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "Open-source framework for publishing content",
        "datePublished": "2015-10-07T12:02:41Z",
        "image": [
            "logo.jpg"
        ]
    }
</script>
    <style amp-boilerplate>body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
    </style>
    <noscript>
        <style amp-boilerplate>body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }</style>
    </noscript>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css')}}" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">


    @yield('style')

</head>
<body>

@yield('content')


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{url('https://code.jquery.com/jquery-3.5.1.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{url('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js')}}" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js')}}" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="{{url('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js')}}"></script>
@yield('script')
</body>
</html>
