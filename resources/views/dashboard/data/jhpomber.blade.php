@extends('layouts.master')
@section('title', 'John Hopkins Data')

@section('css')
    {{--    Datatable CSS--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>John Hopkins University Data - POMBER</h5>
                        <span>Data by date John Hopkins University &amp; Pomber from github <a target="_blank" href="https://pomber.github.io/covid19/timeseries.json">https://pomber.github.io/covid19/timeseries.json</a> <br>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Country</th>
                                    <th>Confirm</th>
                                    <th>Recover</th>
                                    <th>Death</th>
                                </tr>
                                </thead>
                                <tbody>
                                <x-alert/>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->country}}</td>
                                        <td>{{$data->confirm}}</td>
                                        <td>{{$data->recovered}}</td>
                                        <td>{{$data->death}}</td>
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
