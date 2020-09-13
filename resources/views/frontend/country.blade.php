@extends('layouts.frontend')

@section('style')
    <style>
        tfoot tr tr, td {
            text-align: right
        }

        .world {
            background-color: #DFDFDF !important;
            color: #363945 !important;
            font-weight: normal !important;
        }

        .footer_text {
            color: #ddd;

            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            font-size: 12px;
            background-color: #fbfbfb;
            border-top: 1px solid #e3e7e9;
        }
    </style>
@endsection
@section('content')

    <section>
        <div class="container">
            <div class="label-counter" id="page-top">COVID-19 Coronavirus Pandemic</div>
            <center>
                <div style="font-size:13px; color:#999; margin-top:5px; text-align:center">Last Update: {{date('F d, Y, h:i', strtotime($total[0]->created_at))}} UTC</div>
            </center>

            <center class="content-inner">

                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Coronavirus Cases:</h1>
                    <div class="maincounter-number">
                        <span style="color:#aaa">{{!is_numeric($total[0]->total_cases) ? $total[0]->total_cases : number_format($total[0]->total_cases)}}</span>
                    </div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Deaths:</h1>
                    <div class="maincounter-number">{{!is_numeric($total[0]->total_deaths) ? $total[0]->total_deaths : number_format($total[0]->total_deaths)}}</div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px;">
                    <h1>Recovered:</h1>
                    <div class="maincounter-number" style="color:#8ACA2B ">
                        {{!is_numeric($total[0]->total_recovered) ? $total[0]->total_recovered : number_format($total[0]->total_recovered)}}
                    </div>
                </div>
                <div style="margin-top:50px;"></div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header title-case">Active cases</h5>
                            <div class="card-body">
                                <h5 class="card-title number-table-main">{{!is_numeric($total[0]->active_cases) ? $total[0]->active_cases : number_format($total[0]->active_cases)}}</h5>
                                <p style="color: #222">Currently Infected Patients</p>

                                <div class="row">
                                    <div class="col-md-6">
                                <span class="number-table"
                                      style="color: #8080FF;">
                                        @if(empty($total[0]->active_cases))) @php $total[0]->active_cases = 0 @endphp @endif
                                    @if(empty($total[0]->serious)) @php $total[0]->serious = 0 @endphp @endif
                                    {{number_format($total[0]->active_cases - $total[0]->serious)}}</span><br>
                                        <span style="font-size: 13px;">in Mild Condition</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="number-table">{{is_numeric($total[0]->serious) ? number_format($total[0]->serious) : $total[0]->serious}}</span><br>
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
                                    @if(empty($total[0]->total_recovered))) @php $total[0]->total_recovered = 0 @endphp @endif
                                    @if(empty($total[0]->total_deaths))) @php $total[0]->total_deaths = 0 @endphp @endif
                                    {{number_format($total[0]->total_recovered + $total[0]->total_deaths)}}</h5>
                                <p style="color: #222">Cases which had an outcome:</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-table" style="color: #8ACA2B;">{{number_format($total[0]->total_recovered)}}</span>
                                        <span>(<b>{{number_format(100-(($total[0]->total_deaths * 100)/($total[0]->total_recovered + $total[0]->total_deaths)))}}</b>%)</span>
                                        <br>
                                        <span style="font-size: 13px;">Recovered / Discharged</span>
                                    </div>
                                    <div class="col-md-6">
                                <span class="number-table"
                                      style="color: red;">{{number_format($total[0]->total_deaths)}}</span>
                                        <span>(<b>{{number_format(100-(($total[0]->total_recovered * 100)/($total[0]->total_recovered + $total[0]->total_deaths)))}}</b>%)</span>
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
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header title-case">Recovered Statistics</h5>
                            <div class="card-body">
                                <h5 class="card-title number-table-main">
                                    @if(!empty($total[0]->new_recovered))
                                    +{{is_numeric($total[0]->new_recovered) ? number_format($total[0]->new_recovered) : $total[0]->new_recovered}}
                                    @else
                                        +{{is_numeric($yesterday[0]->new_recovered) ? number_format($yesterday[0]->new_recovered) : $yesterday[0]->new_recovered}}
                                        @endif
                                </h5>
                                <p style="color: #222">New Recovered Cases since Yesterday</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header title-case">Death Statistics</h5>
                            <div class="card-body">
                                <h5 class="card-title number-table-main">
                                    @if(!empty($total[0]->new_deaths))
                                    +{{ is_numeric($total[0]->new_deaths) ?  number_format($total[0]->new_deaths) : $total[0]->new_deaths}}
                                    @else
                                        +{{ is_numeric($yesterday[0]->new_deaths) ?  number_format($yesterday[0]->new_deaths) : $yesterday[0]->new_deaths}}
                                        @endif
                                </h5>
                                <p style="color: #222">New Death Cases since Yesterday</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top:50px;"></div>

                {{--                                <div class="row">
                                                    <div class="col-md-12 card">
                                                        <h1>Coronavirus Vaccine Tracker</h1>
                                                        <?php
                                                        include 'includes/vaccine_data.php';
                                                        ?>
                                                        <div>Last <?php echo $time ?></div>
                                                        <br>

                                                        <div class="row">

                                                            <div class="col-md-2" style="background: #B6B6B6; color: white">
                                                                <p>PRECLINICAL <br>
                                                                    <?php echo $preclinical ?> + <br>Vaccines <br> not yet in <br> human trials</p>
                                                            </div>
                                                            <div class="col-md-2" style="background: #75ACC8; color: white">
                                                                <p>PHASE 1 <br> <?php echo $phase1 ?> <br>Vaccines<br> testing safety<br> and dosage</p>
                                                            </div>
                                                            <div class="col-md-3" style="background: #3B89B1; color: white">
                                                                <p>PHASE 2 <br> <?php echo $phase2 ?> <br>Vaccines <br>in expanded<br> safety trials</p>
                                                            </div>
                                                            <div class="col-md-3" style="background: #006699; color: white">
                                                                <p>PHASE 3 <br> <?php echo $phase3 ?> <br>Vaccines<br> in large-scale<br> efficacy tests
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2" style="background: #52887D; color: white">
                                                                <p>APPROVAL <br> <?php echo $approval ?> <br>Vaccines<br> approved for early<br> or limited
                                                                    use</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>--}}
                <div style="margin-top:50px;"></div>
            </center>

            <div>

                <h1>Data Table</h1>

                <table id="dataTable" class="table table-bordered row-border hover order-column">
                    <thead>
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
            </div>

        </div>

        <footer>
            <center>
                <div class="footer_text">© Copyright Saltanat Global Limited - All rights reserved</div>
            </center>
        </footer>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                order: [0, 'desc'],
            });
        });
    </script>
@endsection
