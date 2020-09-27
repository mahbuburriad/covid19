@extends('layouts.master')
@section('title', 'Vaccine Tracker Data')

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
                        <h5>Vaccine Tracker</h5>
                        <span>Data Source <a target="_blank" href="https://www.nytimes.com/interactive/2020/science/coronavirus-vaccine-tracker.html">https://www.nytimes.com/interactive/2020/science/coronavirus-vaccine-tracker.html</a> <br>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Website Time</th>
                                    <th>Phase 1</th>
                                    <th>Phase 2</th>
                                    <th>Phase 3</th>
                                    <th>Limited</th>
                                    <th>Approved</th>
                                </tr>
                                </thead>
                                <tbody>
                                <x-alert/>
                                @foreach($vaccines as $vaccine)
                                    <tr>
                                        <td>{{date('Y-m-d', strtotime($vaccine->date))}}</td>
                                        <td>{{$vaccine->time}}</td>
                                        <td>{{$vaccine->phase1}}</td>
                                        <td>{{$vaccine->phase2}}</td>
                                        <td>{{$vaccine->phase3}}</td>
                                        <td>{{$vaccine->limited}}</td>
                                        <td>{{$vaccine->approved}}</td>
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
