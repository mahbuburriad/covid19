@extends('layouts.frontend')

@section('title') {{$name}} coronavirus update (Live): {{!is_numeric($data[0]->total_cases) ? $data[0]->total_cases : number_format($data[0]->total_cases)}} cases and {{!is_numeric($data[0]->total_deaths) ? $data[0]->total_deaths : number_format($data[0]->total_deaths)}} deaths from @endsection

@section('style')
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css')}}"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css')}}" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />

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
    <p style="margin-left: 22px">Country Name : <b>{{$name}}</b> </p>
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
                                        @if(empty($data[0]->active_cases) || !is_numeric($data[0]->active_cases))) @php $data[0]->active_cases = 0 @endphp @endif
                                    @if(empty($data[0]->serious) || !is_numeric($data[0]->serious)) @php $data[0]->serious = 0 @endphp @endif
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
                                    @if(empty($data[0]->total_recovered) || !is_numeric($data[0]->total_recovered))) @php $data[0]->total_recovered = 0 @endphp @endif
                                    @if(empty($data[0]->total_deaths) || !is_numeric($data[0]->total_deaths))) @php $data[0]->total_deaths = 0 @endphp @endif
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
                                                    <i class="fas fa-arrow-up fa-xs" style="color: green" title="Compare with Yesterday recovered case; Yesterday was {{$yesterday[0]->new_recovered}}"></i>
                                                @else
                                                    <i class="fas fa-arrow-down fa-xs" style="color: red" title="Compare with Yesterday recovered case; Yesterday was {{$yesterday[0]->new_recovered}}"></i>
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
                                            @if(!empty($data[0]->total_tests) && !empty($yesterday[0]->total_tests))
                                            {{ is_numeric($data[0]->total_tests - $yesterday[0]->total_tests) ?  number_format($data[0]->total_tests - $yesterday[0]->total_tests) : $data[0]->total_tests - $yesterday[0]->total_tests}}
                                                @elseif(empty($data[0]->total_tests))
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

                <div class="row card">
                    <div class="card-header">
                        <h6 class="text-center">Chart View</h6>
                    </div>
                    <div class="col-xl-12 card-body">
                        <div class="corona-chart-stats report-item mt-0" id="chart-canvas">
                            <div class="chart-wrap">
                                <canvas id="chart-canvas" style="width: 100%; height: 100%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top:50px;"></div>
            </center>

            @if($name == 'India')
                <div class="table-responsive">
                    <h3>State Wise Data</h3>
                    <table class="table table-striped table-bordered" id="indiaTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>State</th>
                            <th>Total Cases</th>
                            <th>Today's Cases</th>
                            <th>Deaths</th>
                            <th>Today's Deaths</th>
                            <th>Recovered</th>
                            <th>Today's Recovered</th>
                            <th>Active</th>
                            <th>Today's Active</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($indiaData as $value)
                            <tr>
                                <td style="text-align: left">{{$value->state}}</td>
                                <td>{{is_numeric($value->cases) ? number_format($value->cases) : $value->cases}}</td>
                                <td>{{is_numeric($value->todayCases) ? number_format($value->todayCases) : $value->todayCases}}</td>
                                <td>{{is_numeric($value->deaths) ? number_format($value->deaths) : $value->deaths}}</td>
                                <td>{{is_numeric($value->todayDeaths) ? number_format($value->todayDeaths) : $value->todayDeaths}}</td>
                                <td>{{is_numeric($value->recovered) ? number_format($value->recovered) : $value->recovered}}</td>
                                <td>{{is_numeric($value->todayRecovered) ? number_format($value->todayRecovered) : $value->todayRecovered}}</td>
                                <td>{{is_numeric($value->active) ? number_format($value->active) : $value->active}}</td>
                                <td>{{is_numeric($value->todayActive) ? number_format($value->todayActive) : $value->todayActive}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            @if($name == 'US')
                <div class="table-responsive">
                    <h3>State Wise Data</h3>
                    <table class="table table-striped table-bordered" id="usaTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>State</th>
                            <th>Total Cases</th>
                            <th>Today's Cases</th>
                            <th>Deaths</th>
                            <th>Today's Deaths</th>
                            <th>Active</th>
                            <th>Case/1m</th>
                            <th>Death/1m</th>
                            <th>Tests</th>
                            <th>Test/1m</th>
                            <th>Population</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($usaData as $value)
                        <tr>
                            <td style="text-align: left">{{$value->state}}</td>
                            <td>{{is_numeric($value->cases) ? number_format($value->cases) : $value->cases}}</td>
                            <td>{{is_numeric($value->todayCases) ? number_format($value->todayCases) : $value->todayCases}}</td>
                            <td>{{is_numeric($value->deaths) ? number_format($value->deaths) : $value->deaths}}</td>
                            <td>{{is_numeric($value->todayDeaths) ? number_format($value->todayDeaths) : $value->todayDeaths}}</td>
                            <td>{{is_numeric($value->active) ? number_format($value->active) : $value->active}}</td>
                            <td>{{is_numeric($value->casesPerOneMillion) ? number_format($value->casesPerOneMillion) : $value->casesPerOneMillion}}</td>
                            <td>{{is_numeric($value->deathsPerOneMillion) ? number_format($value->deathsPerOneMillion) : $value->deathsPerOneMillion}}</td>
                            <td>{{is_numeric($value->tests) ? number_format($value->tests) : $value->tests}}</td>
                            <td>{{is_numeric($value->testsPerOneMillion) ? number_format($value->testsPerOneMillion) : $value->testsPerOneMillion}}</td>
                            <td>{{is_numeric($value->population) ? number_format($value->population) : $value->population}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

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
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            async function getData(url) {
                let response = await fetch(url);
                return await response.json();
            }


            const chartReport = async (selectorId) => {
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                function chartData(data) {
                    let reports = [];
                    let labels = [];
                    let dates = [];

                    data.map((item, index) => {
                        const value = item.Confirmed - data[index > 0 ? (index - 1) : 0].Confirmed;
                        reports.push(value < 0 ? data[index - 1] : value);
                        labels.push(`Day ${index + 1}`);
                        const d = new Date(item.Date);
                        const day = d.getDate() < 10 ? `0${d.getDate()}` : d.getDate();
                        const month = d.getMonth();
                        const dateUSFormat = `${months[month]} ${day}`;
                        dates.push(dateUSFormat);
                    })

                    const config = {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: '',
                                backgroundColor: '#AEBEFF',
                                borderColor: '#AEBEFF',
                                borderWidth: '5',
                                data: reports,
                                fill: false,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 5
                            }]
                        },
                        options: {
                            height: 450,
                            responsive: true,
                            legend: {
                                display: false
                            },
                            title: {
                                display: false
                            },
                            tooltips: {
                                displayColors: false,
                                backgroundColor: '#fff',
                                titleFontColor: '#354150',
                                bodyFontColor: '#354150',
                                bodyFontSize: 14,
                                xPadding: 10,
                                yPadding: 10,
                                callbacks: {
                                    title: function (tooltipItems) {
                                        return "Day - " + (Number(tooltipItems[0].index) + 1) + ", " + dates[Number(tooltipItems[0].index)];
                                    },
                                    label: function (tooltipItem) {
                                        return "Infected: " + Number(tooltipItem.yLabel) + "+";
                                    }
                                }
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },
                            layout: {
                                padding: {
                                    left: 15,
                                    right: 15,
                                    top: 30,
                                    bottom: 15
                                }
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        color: "rgba(0, 0, 0, 0)",
                                    }
                                }]
                            }
                        }
                    };

                    const canvas = selectorId.querySelector('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.height = 450;
                    window.myLine = new Chart(ctx, config);
                }

                const data = await getData('https://api.covid19api.com/total/dayone/country/'+'{{$name}}');
                chartData(data);
            }

            const chartID = document.getElementById('chart-canvas');
            if (chartID) {
                chartReport(chartID);
            }


            $('#dataTable').DataTable({
                order: [0, 'desc'],
            });

            $('#stateTable').DataTable({
                order: [2, 'desc'],
            });

            $('#usaTable').DataTable({
                order: []
            })
            $('#indiaTable').DataTable({
                order: []
            })
        });
    </script>
@endsection
