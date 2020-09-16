@extends('layouts.frontend')

@section('style')
    <link rel="stylesheet" href="{{url('https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css')}}">
    <style>
        .world {
            background-color: #DFDFDF !important;
            color: #363945 !important;
            font-weight: normal !important;
        }
    </style>
@endsection


@section('content')

    <section>
        <div class="container-fluid">

            <center class="content-inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="maincounter-wrap" style="margin-top:15px">
                            <h1>Bangladesh Cases:</h1>
                            <div class="maincounter-number">
                                <span
                                    style="color:#aaa">{{!is_numeric($bangladesh[0]->total_cases) ? $bangladesh[0]->total_cases : number_format($bangladesh[0]->total_cases)}}</span>
                            </div>
                        </div>
                        <div class="maincounter-wrap" style="margin-top:15px">
                            <h1>Deaths:</h1>
                            <div
                                class="maincounter-number">{{!is_numeric($bangladesh[0]->total_deaths) ? $bangladesh[0]->total_deaths : number_format($bangladesh[0]->total_deaths)}}</div>
                        </div>
                        <div class="maincounter-wrap" style="margin-top:15px;">
                            <h1>Recovered:</h1>
                            <div class="maincounter-number" style="color:#8ACA2B ">
                                {{!is_numeric($bangladesh[0]->total_recovered) ? $bangladesh[0]->total_recovered : number_format($bangladesh[0]->total_recovered)}}
                            </div>
                        </div>
                        <div style="margin-top:50px;"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header title-case">Active cases</h5>
                                    <div class="card-body">
                                        <h5 class="card-title number-table-main">{{!is_numeric($bangladesh[0]->active_cases) ? $bangladesh[0]->active_cases : number_format($bangladesh[0]->active_cases)}}</h5>
                                        <p style="color: #222">Currently Infected Patients</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: #8080FF;">
                                        @if(empty($bangladesh[0]->active_cases))) @php $bangladesh[0]->active_cases = 0 @endphp @endif
                                    @if(empty($bangladesh[0]->serious)) @php $bangladesh[0]->serious = 0 @endphp @endif
                                    {{number_format($bangladesh[0]->active_cases - $bangladesh[0]->serious)}}</span><br>
                                                <span style="font-size: 13px;">in Mild Condition</span>
                                            </div>
                                            <div class="col-md-6">
                                                <span
                                                    class="number-table">{{is_numeric($bangladesh[0]->serious) ? number_format($bangladesh[0]->serious) : $bangladesh[0]->serious}}</span><br>
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
                                            @if(empty($bangladesh[0]->total_recovered))) @php $bangladesh[0]->total_recovered = 0 @endphp @endif
                                            @if(empty($bangladesh[0]->total_deaths))) @php $bangladesh[0]->total_deaths = 0 @endphp @endif
                                            {{number_format($bangladesh[0]->total_recovered + $bangladesh[0]->total_deaths)}}</h5>
                                        <p style="color: #222">Cases which had an outcome:</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="number-table" style="color: #8ACA2B;">{{number_format($bangladesh[0]->total_recovered)}}</span>
                                                <span>(<b>{{number_format(100-(($bangladesh[0]->total_deaths * 100)/($bangladesh[0]->total_recovered + $bangladesh[0]->total_deaths)))}}</b>%)</span>
                                                <br>
                                                <span style="font-size: 13px;">Recovered / Discharged</span>
                                            </div>
                                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: red;">{{number_format($bangladesh[0]->total_deaths)}}</span>
                                                <span>(<b>{{number_format(100-(($bangladesh[0]->total_recovered * 100)/($bangladesh[0]->total_recovered + $bangladesh[0]->total_deaths)))}}</b>%)</span>
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
                                                    +{{is_numeric($bangladesh[0]->new_cases) ? number_format($bangladesh[0]->new_cases) : $bangladesh[0]->new_cases}}
                                                </h5>
                                                <p class="pull-left" style="color: #222">New Confirmed</p>
                                            </div>
                                            <div class="col-md-3">
                                                <h5 class="card-title number-table-main pull-right">
                                                    +{{is_numeric($bangladesh[0]->new_recovered) ? number_format($bangladesh[0]->new_recovered) : $bangladesh[0]->new_recovered}}
                                                </h5>
                                                <p class="pull-right" style="color: #222">New Recovered</p>
                                            </div>

                                            <div class="col-md-3">
                                                <h5 class="card-title number-table-main">
                                                    @if(!empty($bangladesh[0]->new_deaths))
                                                        +{{ is_numeric($bangladesh[0]->new_deaths) ?  number_format($bangladesh[0]->new_deaths) : $bangladesh[0]->new_deaths}}
                                                    @else
                                                        +{{ is_numeric($yesterday[0]->new_deaths) ?  number_format($yesterday[0]->new_deaths) : $yesterday[0]->new_deaths}}
                                                    @endif
                                                </h5>
                                                <p style="color: #222">New Death</p>
                                            </div>
                                            <div class="col-md-3">
                                                <h5 class="card-title number-table-main">
                                                    @if(!empty($bangladesh[0]->total_tests))
                                                        {{ is_numeric($bangladesh[0]->total_tests) ?  number_format($bangladesh[0]->total_tests) : $bangladesh[0]->total_tests}}
                                                    @else
                                                        {{ is_numeric($yesterday[0]->total_tests) ?  number_format($yesterday[0]->total_tests) : $yesterday[0]->total_tests}}
                                                    @endif
                                                </h5>
                                                <p style="color: #222">Total Cases</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div style="margin-top:50px;"></div>
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
                                                <h5 class="card-title number-table-main">+{{number_format($data[0]->new_cases)}}</h5>
                                                <p style="color: #222">New Confirmed</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <h5 class="card-title number-table-main">+{{number_format($data[0]->new_recovered)}}</h5>
                                                <p style="color: #222">New Recovered</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <h5 class="card-title number-table-main">+{{number_format($data[0]->new_deaths)}}</h5>
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
            <div class="table-responsive">

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
                            @endif>
                            <td style="text-align: left"><a @if($all->country != 'World') href="{{route('country', $all->country)}} @endif">{{$all->country}}</a></td>
                            <td>{{!is_numeric($all->total_cases) ? $all->total_cases : number_format($all->total_cases)}}</td>
                            <td @if (!empty($all->new_cases)) style="background: #FFEEAA;" @endif>{{!is_numeric($all->new_cases) ? $all->new_cases : number_format($all->new_cases)}}</td>
                            <td>{{!is_numeric($all->total_deaths) ? $all->total_deaths : number_format($all->total_deaths)}}</td>
                            <td @if (!empty($all->new_deaths)) style="background: red; color: white" @endif>{{!is_numeric($all->new_deaths) ? $all->new_deaths : number_format($all->new_deaths)}}</td>
                            <td>{{!is_numeric($all->total_recovered) ? $all->total_recovered : number_format($all->total_recovered)}}</td>
                            <td @if (!empty($all->new_recovered)) style="background-color:#c8e6c9; color:#000" @endif>{{!is_numeric($all->new_recovered)  ? $all->new_recovered : number_format($all->new_recovered)}}</td>
                            <td>{{!is_numeric($all->active_cases) ? $all->active_cases : number_format($all->active_cases)}}</td>
                            <td>{{!is_numeric($all->serious) ? $all->serious :number_format($all->serious)}}</td>
                            <td>{{!is_numeric($all->tot_cases)  ? $all->tot_cases : number_format($all->tot_cases)}}</td>
                            <td>{{!is_numeric($all->death1m) ? $all->death1m : number_format($all->death1m)}}</td>
                            <td>{{!is_numeric($all->total_tests)  ? $all->total_tests : number_format($all->total_tests)}}</td>
                            <td>{{!is_numeric($all->test1m) ? $all->test1m : number_format($all->test1m)}}</td>
                            <td>{{!is_numeric($all->population) ? $all->population : number_format($all->population)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total:</th>
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
                        <th></th>
                        <th></th>
                        <th></th>
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
    <script type="text/javascript">
        $(document).ready(function () {
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
