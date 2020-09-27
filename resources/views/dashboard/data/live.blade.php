@extends('layouts.master')
@section('title', 'Live Data')

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
                        <h5>Live Data</h5>
                        <span>Data Collected From <a target="_blank" href="https://www.worldometers.info/coronavirus/">https://www.worldometers.info/coronavirus/</a> <br>
                        Data in Frontend <a target="_blank" href="{{route('live')}}">Please click here</a>
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
                            </tr>
                            </thead>
                            <tbody>
                            <x-alert/>
                            @foreach($lives as $live)
                                <tr class="{{$live->country == 'World' ? 'world':''}}">
                                    <td>{{$live->country}}</td>
                                    <td>{{$live->total_cases}}</td>
                                    <td>{{$live->new_cases}}</td>
                                    <td>{{$live->total_deaths}}</td>
                                    <td>{{$live->new_deaths}}</td>
                                    <td>{{$live->total_recovered}}</td>
                                    <td>{{$live->new_recovered}}</td>
                                    <td>{{$live->active_cases}}</td>
                                    <td>{{$live->serious}}</td>
                                    <td>{{$live->tot_cases}}</td>
                                    <td>{{$live->death1m}}</td>
                                    <td>{{$live->total_tests}}</td>
                                    <td>{{$live->test1m}}</td>
                                    <td>{{$live->population}}</td>
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
