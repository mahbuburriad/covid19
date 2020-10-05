@extends('layouts.frontend')

@section('title') Coronavirus Update (Live): {{number_format($data[0]->total_cases)}} Cases and {{number_format($data[0]->total_deaths)}} Deaths from @endsection

@section('style')
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css')}}"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{url('https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css')}}">
    <style>
        .world {
            background-color: #DFDFDF !important;
            color: #363945 !important;
            font-weight: normal !important;
        }

        .fa-arrow-up {
            color: red;
        }

        .fa-arrow-down {
            color: green;
        }

        .GeneratedMarquee {
            line-height:1.3em;
            color:#000000;
            background-color:#c0c0c0;
            padding:7px;
            margin-top: 20px;
        }
        .GeneratedMarqueebangla {
            line-height:1.3em;
            color:#000;
            background-color:#c0c0c0;
            padding:7px;
            margin-top: 5px;
        }

        .percentage{
            color: #696969;
            font-size: 80%;
        }

        .map-status-wrap {
            background-color: #FFFFFF;
            padding: 40px 30px;
        }

        @media only screen and (max-width: 767.98px),
        only screen and (min-width: 768px) and (max-width: 991.98px),
        only screen and (min-width: 992px) and (max-width: 1199.98px) {
            .map-status-wrap {
                margin-top: 30px;
            }
        }

        .map-status-wrap .map-status {
            height: 400px;
            width: 100%;
        }

        @media only screen and (max-width: 767.98px) {
            .map-status-wrap .map-status {
                height: 250px;
            }
        }

        .map-status-colors {
            margin-bottom: 22px;
        }

        .map-status-colors .colors {
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .map-status-colors .colors li {
            font-size: 18px;
            color: #4D4D4D;
        }

        .map-status-colors .colors li:not(:last-child) {
            margin-right: 20px;
        }

        .map-status-colors .colors li span {
            display: inline-block;
            height: 15px;
            width: 15px;
            margin-right: 5px;
        }

        .map-status-colors .colors li span.min {
            background-color: #ACCDDC;
        }

        .map-status-colors .colors li span.mid {
            background-color: #4A97B9;
        }

        .map-status-colors .colors li span.max {
            background-color: #006491;
        }
        .map-status-colors .colors li span.danger {
            background-color: #CA0B00;
        }

        .map-content-wrap .select2-selection__rendered img {
            margin-right: 10px;
        }

    </style>
@endsection

@section('content')

    <section>
        <div class="container-fluid">
            <marquee class="GeneratedMarquee" direction="left" scrollamount="5" behavior="scroll">
                <b>Death rate percentage according to total case confirmed: </b>{{$deathRateNews.'; '}}
                <b>Continents by total affected: </b> @foreach($continentTotalCase as $continent) {{$continent->continent}}, @endforeach
                <b>Total case percentage according to population: </b>{{$totalCaseNews.'; '}}
                <b>Least active cases without death: </b>{{$overComeWithoutLossCountry.'; '}}
                <b>Continents by death rate percentage according to total case confirmed: </b>@foreach($deathContinentNews as $continents) {{$continents->continent}} - {{$continents->death_percent_rate}}%, @endforeach
                <b>Death per 1 million people: </b>{{$death1mNews.'; '}}
                <b>Countries with least active cases: </b> {{$overCome.'; '}}
                <b>Continents by confirmed rate percentage according to population: </b>@foreach($caseContinentNews as $continents) {{$continents->continent}} - {{$continents->total_case_percent}}%, @endforeach
                <b>Total cases per 1 million people: </b>{{$total1mNews.'; '}}
                <b>Most number of affected people today:</b> {{$topFive.'; '}}
            </marquee>

            <marquee class="GeneratedMarqueebangla" direction="left" scrollamount="5" behavior="scroll">
                <b>মোট আক্রান্তের সংখ্যা অনুযায়ী মৃত্যুর হার: </b>{{$deathRateNews.'; '}}
                <b>আক্রান্তের ভিত্তিতে মহাদেশের তালিকা: </b> @foreach($continentTotalCase as $continent) {{$continent->continent}}, @endforeach
                <b>দেশের মোট জনসংখ্যার ভিত্তিতে মোট আক্ত্রান্ত: </b>{{$totalCaseNews.'; '}}
                <b>করনা আক্রান্ত হয়েও মৃত্যু হয়নি: </b>{{$overComeWithoutLossCountry.'; '}}
                <b>আক্রান্তের ভিত্তিতে মৃত্যুর হার অনুযায়ী মহাদেশসমুহ: </b>@foreach($deathContinentNews as $continents) {{$continents->continent}} - {{$continents->death_percent_rate}}%, @endforeach
                <b>প্রতি ১ মিলিয়নে মৃত্যুর হার অনুযায়ী: </b>{{$death1mNews.'; '}}
                <b>বর্তমান সময়ে কোনো সক্রিয় কেস নেই: </b> {{$overCome.'; '}}
                <b>জনসংখার ভিত্তিতে আক্রান্তের হার অনুযায়ী মহাদেশসমুহ: </b>@foreach($caseContinentNews as $continents) {{$continents->continent}} - {{$continents->total_case_percent}}%, @endforeach
                <b>প্রতি ১ মিলিয়নে আক্রান্তের হার অনুযায়ী : </b>{{$total1mNews.'; '}}
                <b>আজকের আক্ত্রান্তের সংখ্যা অনু্যায়ী:</b> {{$topFive.'; '}}

            </marquee>
        </div>
        <div class="container-fluid">

            <center class="content-inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="maincounter-wrap" style="margin-top:15px">
                            <h1>{{$bangladesh[$bdKey]->country}} Cases:</h1>
                            <div class="maincounter-number">
                                <span
                                    style="color:#aaa">{{!is_numeric($bangladesh[$bdKey]->total_cases) ? $bangladesh[$bdKey]->total_cases : number_format($bangladesh[$bdKey]->total_cases)}}</span>
                            </div>
                        </div>
                        <div class="maincounter-wrap" style="margin-top:15px">
                            <h1>Deaths:</h1>
                            <div
                                class="maincounter-number">{{!is_numeric($bangladesh[$bdKey]->total_deaths) ? $bangladesh[$bdKey]->total_deaths : number_format($bangladesh[$bdKey]->total_deaths)}}</div>
                        </div>
                        <div class="maincounter-wrap" style="margin-top:15px;">
                            <h1>Recovered:</h1>
                            <div class="maincounter-number" style="color:#8ACA2B ">
                                {{!is_numeric($bangladesh[$bdKey]->total_recovered) ? $bangladesh[$bdKey]->total_recovered : number_format($bangladesh[$bdKey]->total_recovered)}}
                            </div>
                        </div>
                        <div style="margin-top:50px;"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header title-case">Active cases</h5>
                                    <div class="card-body">
                                        <h5 class="card-title number-table-main">{{!is_numeric($bangladesh[$bdKey]->active_cases) ? $bangladesh[$bdKey]->active_cases : number_format($bangladesh[$bdKey]->active_cases)}}</h5>
                                        <p style="color: #222">Currently Infected Patients</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: #8080FF;">
                                        @if(empty($bangladesh[$bdKey]->active_cases))) @php $bangladesh[$bdKey]->active_cases = 0 @endphp @endif
                                    @if(empty($bangladesh[$bdKey]->serious)) @php $bangladesh[$bdKey]->serious = 0 @endphp @endif
                                    {{number_format($bangladesh[$bdKey]->active_cases - $bangladesh[$bdKey]->serious)}}</span><br>
                                                <span style="font-size: 13px;">in Mild Condition</span>
                                            </div>
                                            <div class="col-md-6">
                                                <span
                                                    class="number-table">{{is_numeric($bangladesh[$bdKey]->serious) ? number_format($bangladesh[$bdKey]->serious) : $bangladesh[$bdKey]->serious}}</span><br>
                                                <span style="font-size: 13px;">Serious or Critical</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header title-case">Closed cases</h5>
                                    <div class="card-body">
                                        <h5 class="card-title number-table-main">
                                            @if(empty($bangladesh[$bdKey]->total_recovered))) @php $bangladesh[$bdKey]->total_recovered = 0 @endphp @endif
                                            @if(empty($bangladesh[$bdKey]->total_deaths))) @php $bangladesh[$bdKey]->total_deaths = 0 @endphp @endif
                                            {{number_format($bangladesh[$bdKey]->total_recovered + $bangladesh[$bdKey]->total_deaths)}}</h5>
                                        <p style="color: #222">Cases which had an outcome:</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="number-table" style="color: #8ACA2B;">{{number_format($bangladesh[$bdKey]->total_recovered)}}</span>
                                                <span>(<b>{{number_format(100-(($bangladesh[$bdKey]->total_deaths * 100)/($bangladesh[$bdKey]->total_recovered + $bangladesh[$bdKey]->total_deaths)))}}</b>%)</span>
                                                <br>
                                                <span style="font-size: 13px;">Recovered / Discharged</span>
                                            </div>
                                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: red;">{{number_format($bangladesh[$bdKey]->total_deaths)}}</span>
                                                <span>(<b>{{number_format(100-(($bangladesh[$bdKey]->total_recovered * 100)/($bangladesh[$bdKey]->total_recovered + $bangladesh[$bdKey]->total_deaths)))}}</b>%)</span>
                                                <br>
                                                <span style="font-size: 13px;">Deaths</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div style="margin-top:50px;"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <h5 class="card-header title-case">New Statistics</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">

                                                <h5 class="card-title number-table-main pull-left">
                                                    @if(!empty($bangladesh[$bdKey]->new_cases))
                                                        +{{is_numeric($bangladesh[$bdKey]->new_cases) ? number_format($bangladesh[$bdKey]->new_cases) : $bangladesh[$bdKey]->new_cases}}

                                                        @if($bangladesh[$bdKey]->new_cases > $yesterday[0]->new_cases)
                                                            <i class="fas fa-arrow-up fa-xs" title="Compared with yesterday confirmed case; Yesterday was {{$yesterday[0]->new_cases}}}"></i>
                                                        @else
                                                            <i class="fas fa-arrow-down fa-xs" title="Compared with yesterday confirmed case; Yesterday was {{$yesterday[0]->new_cases}}"></i>
                                                        @endif
                                                    @else
                                                        +{{is_numeric($yesterday[0]->new_cases) ? number_format($yesterday[0]->new_cases) : $yesterday[0]->new_cases}}
                                                        <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                                    @endif
                                                </h5>

                                                <p class="pull-left" style="color: #222">{{!empty($bangladesh[$bdKey]->new_cases) ? 'New' : 'Yesterday'}} Confirmed</p>
                                            </div>
                                            <div class="col-md-3">

                                                <h5 class="card-title number-table-main pull-right">
                                                    @if(!empty($bangladesh[$bdKey]->new_recovered))
                                                        +{{is_numeric($bangladesh[$bdKey]->new_recovered) ? number_format($bangladesh[$bdKey]->new_recovered) : $bangladesh[$bdKey]->new_recovered}}
                                                        @if($bangladesh[$bdKey]->new_recovered > $yesterday[0]->new_recovered)
                                                            <i class="fas fa-arrow-up fa-xs" style="color: green" title="Compare with Yesterday recovered case; Yesterday was {{$yesterday[0]->new_recovered}}"></i>
                                                        @else
                                                            <i class="fas fa-arrow-down fa-xs" style="color: red" title="Compare with Yesterday recovered case; Yesterday was {{$yesterday[0]->new_recovered}}"></i>
                                                        @endif
                                                    @else
                                                        +{{is_numeric($yesterday[0]->new_recovered) ? number_format($yesterday[0]->new_recovered) : $yesterday[0]->new_recovered}}
                                                        <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                                    @endif
                                                </h5>
                                                <p class="pull-right" style="color: #222">{{!empty($bangladesh[$bdKey]->new_recovered) ? 'New' : 'Yesterday'}} Recovered</p>
                                            </div>

                                            <div class="col-md-3">
                                                <h5 class="card-title number-table-main">
                                                    @if(!empty($bangladesh[$bdKey]->new_deaths))
                                                        +{{ is_numeric($bangladesh[$bdKey]->new_deaths) ?  number_format($bangladesh[$bdKey]->new_deaths) : $bangladesh[$bdKey]->new_deaths}}
                                                        @if($bangladesh[$bdKey]->new_deaths > $yesterday[0]->new_deaths)
                                                            <i class="fas fa-arrow-up fa-xs" title="Compare with Yesterday death case; Yesterday was {{$yesterday[0]->new_deaths}}"></i>
                                                        @else
                                                            <i class="fas fa-arrow-down fa-xs" title="Compare with Yesterday death case; Yesterday was {{$yesterday[0]->new_deaths}}"></i>
                                                        @endif
                                                    @else
                                                        +{{ is_numeric($yesterday[0]->new_deaths) ?  number_format($yesterday[0]->new_deaths) : $yesterday[0]->new_deaths}}
                                                        <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                                    @endif
                                                </h5>
                                                <p style="color: #222">{{!empty($bangladesh[$bdKey]->new_deaths) ? 'New' : 'Yesterday'}} Death</p>
                                            </div>
                                            <div class="col-md-3">
                                                <h5 class="card-title number-table-main">
                                                    {{ is_numeric($bangladesh[$bdKey]->total_tests - $yesterday[0]->total_tests) ?  number_format($bangladesh[$bdKey]->total_tests - $yesterday[0]->total_tests) : $bangladesh[$bdKey]->total_tests - $yesterday[0]->total_tests}}
                                                    @if(empty($bangladesh[$bdKey]->total_tests))
                                                        <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                                    @endif
                                                </h5>
                                                <p style="color: #222">New Test</p>
                                            </div>
                                        </div>
                                        @if(!empty($bangladesh[$bdKey]->new_cases))
                                        <div class="row">
                                            <div class="col-md-12">
                                                Today's new confirmed affected rate among total Tests: {{number_format((($bangladesh[$bdKey]->new_cases)*100)/($bangladesh[$bdKey]->total_tests - $yesterday[0]->total_tests), 2)}}%
                                            </div>
                                        </div>
                                            @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="text-left d-md-none d-sm-block d-xs-none" style="margin-top: 10px">
                            <i class="fas fa-arrow-up fa-xs"></i> = Rate is increasing than yesterday <br>
                            <i class="fas fa-arrow-down fa-xs"></i> = Rate is decreasing than yesterday <br>
                            <i class="fas fa-thermometer-empty fa-xs"></i> = Today's data is not updated yet
                        </div>
                    </div>


                    <div class="col-md-6">

                                <div class="maincounter-wrap" style="margin-top:15px">
                                    <h1>World Cases:</h1>
                                    <div class="maincounter-number">
                                        <span style="color:#aaa">{{number_format($data[0]->total_cases)}}</span>
                                    </div>
                                </div>
                                <div class="maincounter-wrap" style="margin-top:15px">
                                    <h1>Deaths:</h1>
                                    <div class="maincounter-number">{{number_format($data[0]->total_deaths)}}</div>
                                </div>
                                <div class="maincounter-wrap" style="margin-top:15px;">
                                    <h1>Recovered:</h1>
                                    <div class="maincounter-number" style="color:#8ACA2B ">
                                        {{number_format($data[0]->total_recovered)}}
                                    </div>
                                </div>

                        <div style="margin-top:50px;"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header title-case">Active cases</h5>
                                    <div class="card-body">
                                        <h5 class="card-title number-table-main">{{number_format($data[0]->active_cases)}}</h5>
                                        <p style="color: #222">Currently Infected Patients</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: #8080FF;">{{number_format($data[0]->active_cases - $data[0]->serious)}}</span><br>
                                                <span style="font-size: 13px;">in Mild Condition</span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="number-table">{{number_format($data[0]->serious)}}</span><br>
                                                <span style="font-size: 13px;">Serious or Critical</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header title-case">Closed cases</h5>
                                    <div class="card-body">
                                        <h5 class="card-title number-table-main">{{number_format($data[0]->total_recovered + $data[0]->total_deaths)}}</h5>
                                        <p style="color: #222">Cases which had an outcome:</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="number-table" style="color: #8ACA2B;">{{number_format($data[0]->total_recovered)}}</span>
                                                <span>(<b>{{number_format(100-(($data[0]->total_deaths * 100)/($data[0]->total_recovered + $data[0]->total_deaths)))}}</b>%)</span>
                                                <br>
                                                <span style="font-size: 13px;">Recovered / Discharged</span>
                                            </div>
                                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: red;">{{number_format($data[0]->total_deaths)}}</span>
                                                <span>(<b>{{number_format(100-(($data[0]->total_recovered * 100)/($data[0]->total_recovered + $data[0]->total_deaths)))}}</b>%)</span>
                                                <br>
                                                <span style="font-size: 13px;">Deaths</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top:50px;"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <h5 class="card-header title-case">New Statistics</h5>
                                    <div class="row">


                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <h5 class="card-title number-table-main">+{{number_format($data[0]->new_cases)}} </h5> {{--<span class="percentage">({{number_format((($data[0]->new_cases)*100)/($data[0]->total_tests), 2)}})%</span>--}}
                                                <p style="color: #222">New Confirmed</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <h5 class="card-title number-table-main">+{{number_format($data[0]->new_recovered)}}</h5> {{--<span class="percentage">({{number_format((($data[0]->new_recovered)*100)/($data[0]->total_tests), 2)}})%</span>--}}
                                                <p style="color: #222">New Recovered</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <h5 class="card-title number-table-main">+{{number_format($data[0]->new_deaths)}}</h5> {{--<span class="percentage">({{number_format((($data[0]->new_deaths)*100)/($data[0]->total_tests), 2)}})%</span>--}}
                                                <p style="color: #222">New Death</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div style="margin-top:50px;"></div>

                    </div>
                </div>
            </center>

            <div class="row">
                <div class="col-md-6 text-center" {{--style="color: white"--}}>
                    <div class="d-md-none d-sm-block d-xs-none" style="margin-top: 35px"></div>
                    <h1 style="color: #555">Vaccine Tracker</h1>
                    <a target="_blank" style="font-size: 80%; color: #555" href="https://www.nytimes.com/interactive/2020/science/coronavirus-vaccine-tracker.html">Data Source: The New York Times</a>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #75ACC8"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->phase1}}
                                </div>
                                <div class="card-body">
                                    PHASE 1 (Testing safety and dosage)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #3B89B1;"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->phase2}}
                                </div>
                                <div class="card-body">
                                    PHASE 2 (In expanded safety trials)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #006699"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->phase3}}
                                </div>
                                <div class="card-body">
                                    PHASE 3 (In large-scale efficacy tests)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #719D94;"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->limited}}
                                </div>
                                <div class="card-body">
                                    LIMITED (Approved for early or limited use)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-12">
                            <div class="card" {{--style="background-color: #006E59;"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->approved}}
                                </div>
                                <div class="card-body">
                                    APPROVED (Approved for full use)
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map-status-wrap" id="map-status-report">
                        <div class="map-status-colors">
                            <ul class="colors d-flex">
                                <li><span class="min" title="Total Case below 50,000"></span>&#60;50k</li>
                                <li><span class="mid" title="Total Case below 100,000"></span>&#60;100k</li>
                                <li><span class="max" title="Total Case below 5,000,000"></span>&#60;5M</li>
                                <li><span class="danger" title="Total Case above 5,000,000"></span>&#62;5M</li>
                            </ul>
                        </div>

                        <div class="map-status" id="map-status"></div>
                    </div>
                </div>
            </div>

            <div class="table-responsive" style="margin-top: 25px">

                <h1>Data Table</h1>

                <table id="dataTable" class="table table-bordered row-border hover order-column"
                       cellspacing="0" width="100%">
                    <thead style="color: #666666">
                    <tr>
                        <th>Country,<br/>Other</th>
                        <th>Total<br/>Cases</th>
                        <th>New<br/>Cases</th>
                        <th>Total<br/>Deaths</th>
                        <th>New<br/>Deaths</th>
                        <th>Total<br/>Recovered</th>
                        <th>New<br/>Recovered</th>
                        <th>Active<br/>Cases</th>
                        <th>Serious,<br/>Critical</th>
                        <th>Tot&nbsp;Cases/<br/>1M pop</th>
                        <th>Deaths/<br/>1M pop</th>
                        <th>Total<br/>Tests</th>
                        <th>Tests/<br/>
                            <nobr>1M pop</nobr>
                        </th>
                        <th>Population</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $all)
                        <tr @if($all->total_cases == $all->total_recovered)
                            style="background: #EAF7D5;"
                            @elseif ($all->active_cases == 0)
                            style="background: #F0F0F0;"
                            @elseif($all->country == 'World')
                                class="world"
                            @else
                            style="background: white;"
                            @endif>
                            <td style="text-align: left"><a @if($all->country != 'World') href="{{route('country', $all->country)}} @endif">{{$all->country}}</a></td>
                            <td>{{!is_numeric($all->total_cases) ? $all->total_cases : number_format($all->total_cases)}}
                                @if($all->country != 'World')
                                    @if(!is_numeric($all->population))
                                        @php $all->population = 1 @endphp
                                    @endif

                                @if($all->population != '1')
                                <span class="percentage" title="Total case confirmed according to population">
                                    ({{number_format((($all->total_cases)*100)/($all->population), 2)}})%
                                </span>
                                    @endif
                                @else
                                    <span class="percentage" title="Total case confirmed according to population">
                                    ({{number_format((($all->total_cases)*100)/$totalPopulation, 2)}})%
                                </span>
                                    @endif
                            </td>
                            <td @if (!empty($all->new_cases)) style="background: #FFEEAA;" @endif>{{!is_numeric($all->new_cases) ? $all->new_cases : number_format($all->new_cases)}}</td>
                            <td>{{!is_numeric($all->total_deaths) ? $all->total_deaths : number_format($all->total_deaths)}}

                                @if(!is_numeric($all->total_deaths))
                                    @php $all->total_deaths = 0 @endphp
                                @endif
                                <span class="percentage" title="Death percentage according to total cases confirmed">
                                    ({{number_format((($all->total_deaths)*100)/($all->total_cases), 2)}})%
                                </span>
                            </td>
                            <td @if (!empty($all->new_deaths)) style="background: red; color: white" @endif>{{!is_numeric($all->new_deaths) ? $all->new_deaths : number_format($all->new_deaths)}}</td>
                            <td>{{!is_numeric($all->total_recovered) ? $all->total_recovered : number_format($all->total_recovered)}}</td>
                            <td @if (!empty($all->new_recovered)) style="background-color:#c8e6c9; color:#000" @endif>{{!is_numeric($all->new_recovered)  ? $all->new_recovered : number_format($all->new_recovered)}}</td>
                            <td>{{!is_numeric($all->active_cases) ? $all->active_cases : number_format($all->active_cases)}}</td>
                            <td>{{!is_numeric($all->serious) ? $all->serious :number_format($all->serious)}}</td>
                            <td>{{!is_numeric($all->tot_cases)  ? $all->tot_cases : number_format($all->tot_cases)}}</td>
                            <td>{{!is_numeric($all->death1m) ? $all->death1m : number_format($all->death1m)}}</td>
                            <td>{{!is_numeric($all->total_tests)  ? $all->total_tests : number_format($all->total_tests)}}</td>
                            <td>{{!is_numeric($all->test1m) ? $all->test1m : number_format($all->test1m)}}</td>
                            <td>
                                @if($all->population != '1')
                                    {{!is_numeric($all->population) ? $all->population : number_format($all->population)}}
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="text-align: left">Total:</th>
                        <th>{{number_format($data[0]->total_cases)}}</th>
                        <th style="background: #FFEEAA;">{{number_format($data[0]->new_cases)}}</th>
                        <th>{{number_format($data[0]->total_deaths)}}</th>
                        <th style="background: red; color: white;">{{number_format($data[0]->new_deaths)}}</th>
                        <th>{{number_format($data[0]->total_recovered)}}</th>
                        <th style="background-color:#c8e6c9; color:#000">{{number_format($data[0]->new_recovered)}}</th>
                        <th>{{number_format($data[0]->active_cases)}}</th>
                        <th>{{number_format($data[0]->serious)}}</th>
                        <th>{{number_format($data[0]->tot_cases)}}</th>
                        <th>{{number_format($data[0]->death1m)}}</th>
                        <th>{{!is_numeric($data[0]->total_tests)  ? $data[0]->total_tests : number_format($data[0]->total_tests)}}</th>
                        <th>{{!is_numeric($data[0]->test1m) ? $data[0]->test1m : number_format($data[0]->test1m)}}</th>
                        <th>{{number_format($totalPopulation)}}</th>
                    </tr>

                    </tfoot>
                </table>
            </div>
            <div style="font-size:13px; margin-top:10px; padding-bottom:10px">
                <div style="background-color:#EAF7D5; padding:5px; float:left">Highlighted in green</div>
                <div style="padding:5px; float:left">
                    = all cases have recovered from the infection
                </div>
            </div>
            <div style="clear:both; font-size:13px; margin-top:25px; padding-bottom:45px">
                <div style="background-color:#F0F0F0; padding:5px; float:left">Highlighted in grey</div>
                <div style="padding:5px; float:left">
                    = all cases have had an outcome (there are no active cases)
                </div>
            </div>
        </div>

        </div>
    </section>

@endsection

@section('script')
    <script src="{{url('https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js')}}"></script>
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.world.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            // API BASE URL
            const BASE_URL = "https://corona.lmao.ninja/";

            /**
             *  Function for Fetch Data
             * @param url
             * @returns {Promise<any>}
             */
            async function getData(url) {
                let response = await fetch(url);
                return await response.json();
            }

            const mapStatus = async function (selectorID) {
                const countriesData = await getData(BASE_URL + 'v2/countries');
                const map = selectorID.querySelector('#map-status');
                const mostCases = "#006491";
                const mediumCases = "#4A97B9";
                const minCases = "#ACCDDC";
                const dangerArea = "#CA0B00";
/*                const mostCases = "#7C0A02";
                const mediumCases = "#C21807";
                const minCases = "#ED2939";*/
                const mapColors = {};

                countriesData.map(async (country) => {
                    if (country.countryInfo.iso2) {
                        const countryCode = country.countryInfo.iso2.toLowerCase();
                        if (country.cases >= 0 && country.cases <= 50000) {
                            mapColors[countryCode] = minCases;
                        } else if (country.cases > 50000 && country.cases <= 100000) {
                            mapColors[countryCode] = mediumCases;
                        } else if (country.cases > 100000 && country.cases <= 5000000) {
                            mapColors[countryCode] = mostCases;
                        } else if(country.cases > 5000000){
                            mapColors[countryCode] = dangerArea;
                        }
                    }
                })

                jQuery(map).vectorMap({
                    map: 'world_en',
                    backgroundColor: null,
                    borderColor: '#fff',
                    borderOpacity: 0.1,
                    borderWidth: 1,
                    enableZoom: false,
                    hoverColor: null,
                    hoverOpacity: null,
                    normalizeFunction: 'linear',
                    scaleColors: ['#b6d6ff', '#005ace'],
                    selectedColor: null,
                    selectedRegions: null,
                    showTooltip: true,
                    colors: mapColors,
                    onLabelShow: async function (event, label, code) {
                        const cdata = await getData(BASE_URL + `v2/countries/${code}`);
                        const country = `${cdata.country}`;
                        const confirmed = `: Confirmed : ${cdata.cases}`;
                        const death= `, Death : ${cdata.deaths}`;
                        const recovered= `, Recovered : ${cdata.deaths}`;
                        const ddd = country+confirmed+death+recovered;
                        if (label.length) {
                            label[0].innerText = ddd;
                        } else {
                            event.preventDefault();
                        }
                    },
                });
            }


            const mapWiseReport = document.getElementById('map-status-report');
            if (mapWiseReport) {
                mapStatus(mapWiseReport);
            }

            $('#dataTable').DataTable({
                order: [],
                lengthChange: false,
                paging: false,
                info: false,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                responsive: true
            });
            $('#dataTable tbody tr').each(function (i) {
                if (i == 0) {
                    $(this).prepend("<td></td>")
                } else {
                    $(this).prepend("<td>" + (i) + "</td>")
                }

            })
            $('#dataTable thead tr').each(function (i) {
                $(this).prepend("<th>#</th>")
            })
            $('#dataTable tfoot tr').each(function (i) {
                $(this).prepend("<th></th>")
            })
        });
    </script>

@endsection
