@extends('layouts.frontend')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous"/>
    <style>
        .stateData td{
            text-align: left;
        }
        .fa-arrow-up {
            color: red;
        }

        .fa-arrow-down {
            color: green;
        }
    </style>
@endsection

@section('country')
    <br>
    <h6>Country Name : <b>{{$name}}</b> </h6>
@endsection


@section('content')

    <section>
        <div class="container">

            <center class="content-inner">

                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Coronavirus Cases:</h1>
                    <div class="maincounter-number">
                        <span style="color:#aaa">{{!is_numeric($data[0]->total_cases) ? $data[0]->total_cases : number_format($data[0]->total_cases)}}</span>
                    </div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Deaths:</h1>
                    <div class="maincounter-number">{{!is_numeric($data[0]->total_deaths) ? $data[0]->total_deaths : number_format($data[0]->total_deaths)}}</div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px;">
                    <h1>Recovered:</h1>
                    <div class="maincounter-number" style="color:#8ACA2B ">
                        {{!is_numeric($data[0]->total_recovered) ? $data[0]->total_recovered : number_format($data[0]->total_recovered)}}
                    </div>
                </div>
                <div style="margin-top:50px;"></div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header title-case">Active cases</h5>
                            <div class="card-body">
                                <h5 class="card-title number-table-main">{{!is_numeric($data[0]->active_cases) ? $data[0]->active_cases : number_format($data[0]->active_cases)}}</h5>
                                <p style="color: #222">Currently Infected Patients</p>

                                <div class="row">
                                    <div class="col-md-6">
                                <span class="number-table"
                                      style="color: #8080FF;">
                                        @if(empty($data[0]->active_cases))) @php $data[0]->active_cases = 0 @endphp @endif
                                    @if(empty($data[0]->serious)) @php $data[0]->serious = 0 @endphp @endif
                                    {{number_format($data[0]->active_cases - $data[0]->serious)}}</span><br>
                                        <span style="font-size: 13px;">in Mild Condition</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="number-table">{{is_numeric($data[0]->serious) ? number_format($data[0]->serious) : $data[0]->serious}}</span><br>
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
                                    @if(empty($data[0]->total_recovered))) @php $data[0]->total_recovered = 0 @endphp @endif
                                    @if(empty($data[0]->total_deaths))) @php $data[0]->total_deaths = 0 @endphp @endif
                                    {{number_format($data[0]->total_recovered + $data[0]->total_deaths)}}</h5>
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">

                                        <h5 class="card-title number-table-main pull-left">
                                            @if(!empty($data[0]->new_cases))
                                                +{{is_numeric($data[0]->new_cases) ? number_format($data[0]->new_cases) : $data[0]->new_cases}}

                                                @if($data[0]->new_cases > $yesterday[0]->new_cases)
                                                    <i class="fas fa-arrow-up fa-xs" title="Compared with yesterday confirmed case; Yesterday was {{$yesterday[0]->new_cases}}}"></i>
                                                @else
                                                    <i class="fas fa-arrow-down fa-xs" title="Compared with yesterday confirmed case; Yesterday was {{$yesterday[0]->new_cases}}"></i>
                                                @endif
                                            @else
                                                +{{is_numeric($yesterday[0]->new_cases) ? number_format($yesterday[0]->new_cases) : $yesterday[0]->new_cases}}
                                                <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                            @endif
                                        </h5>

                                        <p class="pull-left" style="color: #222">{{!empty($data[0]->new_cases) ? 'New' : 'Yesterday'}} Confirmed</p>
                                    </div>
                                    <div class="col-md-3">

                                        <h5 class="card-title number-table-main pull-right">
                                            @if(!empty($data[0]->new_recovered))
                                                +{{is_numeric($data[0]->new_recovered) ? number_format($data[0]->new_recovered) : $data[0]->new_recovered}}
                                                @if($data[0]->new_recovered > $yesterday[0]->new_recovered)
                                                    <i class="fas fa-arrow-up fa-xs" title="Compare with Yesterday recovered case; Yesterday was {{$yesterday[0]->new_recovered}}"></i>
                                                @else
                                                    <i class="fas fa-arrow-down fa-xs" title="Compare with Yesterday recovered case; Yesterday was {{$yesterday[0]->new_recovered}}"></i>
                                                @endif
                                            @else
                                                +{{is_numeric($yesterday[0]->new_recovered) ? number_format($yesterday[0]->new_recovered) : $yesterday[0]->new_recovered}}
                                                <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                            @endif
                                        </h5>
                                        <p class="pull-right" style="color: #222">{{!empty($data[0]->new_recovered) ? 'New' : 'Yesterday'}} Recovered</p>
                                    </div>

                                    <div class="col-md-3">
                                        <h5 class="card-title number-table-main">
                                            @if(!empty($data[0]->new_deaths))
                                                +{{ is_numeric($data[0]->new_deaths) ?  number_format($data[0]->new_deaths) : $data[0]->new_deaths}}
                                                @if($data[0]->new_deaths > $yesterday[0]->new_deaths)
                                                    <i class="fas fa-arrow-up fa-xs" title="Compare with Yesterday death case; Yesterday was {{$yesterday[0]->new_deaths}}"></i>
                                                @else
                                                    <i class="fas fa-arrow-down fa-xs" title="Compare with Yesterday death case; Yesterday was {{$yesterday[0]->new_deaths}}"></i>
                                                @endif
                                            @else
                                                +{{ is_numeric($yesterday[0]->new_deaths) ?  number_format($yesterday[0]->new_deaths) : $yesterday[0]->new_deaths}}
                                                <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                            @endif
                                        </h5>
                                        <p style="color: #222">{{!empty($data[0]->new_deaths) ? 'New' : 'Yesterday'}} Death</p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="card-title number-table-main">
                                            {{ is_numeric($data[0]->total_tests - $yesterday[0]->total_tests) ?  number_format($data[0]->total_tests - $yesterday[0]->total_tests) : $data[0]->total_tests - $yesterday[0]->total_tests}}
                                            @if(empty($data[0]->total_tests))
                                                <i class="fas fa-thermometer-empty fa-xs" title="Today's data is not updated yet"></i>
                                            @endif
                                        </h5>
                                        <p style="color: #222">New Test</p>
                                    </div>
                                </div>
                                @if(!empty($data[0]->new_cases))
                                    <div class="row">
                                        <div class="col-md-12">
                                            Today's new confirmed affected rate among total Tests: {{number_format((($data[0]->new_cases)*100)/($data[0]->total_tests - $yesterday[0]->total_tests), 2)}}%
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
                <div style="margin-top:50px;"></div>

            </center>

            <div>
                @if($name == 'Bangladesh')
                    <div class="row">
                        <div class="col-md-6">
                @endif
                <h3>Date Wise Data</h3>

                <table id="dataTable" class="table table-bordered row-border hover order-column">
                    <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Confirmed</th>
                        <th>Recovered</th>
                        <th>Death</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($country as $countrys)
                        <tr>
                            <td style="text-align: left"> {{$countrys->date}}</td>
                            <td>{{number_format($countrys->confirm)}}</td>
                            <td>{{number_format($countrys->recovered)}}</td>
                            <td>{{number_format($countrys->death)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                            @if($name == 'Bangladesh')
                        </div>
                        <div class="col-md-6">
                                <h3>District Wise Data</h3>
                                <table id="stateTable" class="table table-bordered row-border hover order-column">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>#</th>
                                        {{--<th>sss</th>--}}
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($states as $state)
                                        <tr class="stateData">
                                            <td>{{$state->state}}</td>
                                            <td>{{$state->district}}</td>
                                            <td style="text-align: right">{{number_format($state->numberOfPeople)}}</td>
                                            {{--<td>{{$state->booted}}</td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                                @endif
            </div>

        </div>


    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                order: [0, 'desc'],
            });

            $('#stateTable').DataTable({
                order: [2, 'desc'],
            });
        });
    </script>
@endsection
