@extends('layouts.master')
@section('title', 'Worldometer Data')

@section('css')
    {{--    Datatable CSS--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endsection

@section('style')
    <style>
        .world {
            background-color: #DFDFDF !important;
            color: #363945 !important;
            font-weight: normal !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Worldometer Data</h5>
                        <span>Data Collected From <a target="_blank" href="https://www.worldometers.info/coronavirus/">https://www.worldometers.info/coronavirus/</a> <br>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
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
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <x-alert/>
                                @foreach($worldometers as $worldometer)
                                    <tr class="{{$worldometer->country == 'World' ? 'world':''}}">
                                        <td>{{$worldometer->country}}</td>
                                        <td>{{$worldometer->total_cases}}</td>
                                        <td>{{$worldometer->new_cases}}</td>
                                        <td>{{$worldometer->total_deaths}}</td>
                                        <td>{{$worldometer->new_deaths}}</td>
                                        <td>{{$worldometer->total_recovered}}</td>
                                        <td>{{$worldometer->new_recovered}}</td>
                                        <td>{{$worldometer->active_cases}}</td>
                                        <td>{{$worldometer->serious}}</td>
                                        <td>{{$worldometer->tot_cases}}</td>
                                        <td>{{$worldometer->death1m}}</td>
                                        <td>{{$worldometer->total_tests}}</td>
                                        <td>{{$worldometer->test1m}}</td>
                                        <td>{{$worldometer->population}}</td>
                                        <td>{{date('Y-m-d', strtotime($worldometer->date))}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Plugins DataTable start-->
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script type="application/javascript">
        $(document).ready( function () {
            $('#dataTable').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
