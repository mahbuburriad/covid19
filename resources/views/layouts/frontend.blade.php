<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css')}}" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">


    @yield('style')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178645137-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-178645137-1');
    </script>

</head>
<body>

<section>
    <div class="container-fluid">
    <div class="label-counter" id="page-top">COVID-19 Coronavirus Pandemic @yield('country') </div>

    <center>
        <div style="font-size:13px; color:#999; margin-top:5px; text-align:center">Last Update: {{date('F d, Y G:i A', strtotime($data[0]->created_at))}} UTC <br> Local Time : <span id = "localTime"></span> </div>
        @include('includes.menu')
    </center>


    </div>
</section>

@yield('content')

<h5>Data Source</h5>
<p> <b>Live Data Source:</b> https://www.worldometers.info/ <br> <b>Data by date John Hopkins University &amp; Pomber from github:</b> https://pomber.github.io/covid19
    <br> <b>Bangladesh District Wise Data source:</b> http://dashboard.dghs.gov.bd/webportal/pages/covid19.php </p>

<footer>
    <center>
        <div class="footer_text">© Copyright Saltanat Global Limited - All rights reserved</div>
    </center>
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{url('https://code.jquery.com/jquery-3.5.1.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{url('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js')}}" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js')}}" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="{{url('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js')}}" integrity="sha512-Q1f3TS3vSt1jQ8AwP2OuenztnLU6LwxgyyYOG1jgMW/cbEMHps/3wjvnl1P3WTrF3chJUWEoxDUEjMxDV8pujg==" crossorigin="anonymous"></script>
@yield('script')

<script>
    $(document).ready(function() {
        var a = moment.utc([{{date('Y,m-1,d,G,i', strtotime($data[0]->created_at))}}]);
        $("#localTime").text(a.local().format('LLL'));
    });
</script>
</body>
</html>
