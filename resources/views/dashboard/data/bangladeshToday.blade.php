@extends('layouts.master')
@section('title', 'Today Bangladesh District Data')

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
                        <h5>Bangladesh District Data - Today</h5>
                        <span>Data collected from <a target="_blank" href="http://dashboard.dghs.gov.bd/webportal/pages/covid19.php">http://dashboard.dghs.gov.bd/webportal/pages/covid19.php</a> <br>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Affected</th>
                                </tr>
                                </thead>
                                <tbody>
                                <x-alert/>
                                @foreach($bangladesh as $bd)
                                    <tr>
                                        <td>{{$bd->state}}</td>
                                        <td>{{$bd->district}}</td>
                                        <td>{{$bd->numberOfPeople}}</td>
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
                "order": [2, 'desc'],
            });
        });
    </script>
@endsection
