@extends('layouts.master')
@section('title', 'Supplier List')

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
                    <div class="card-body">
                        <x-alert/>
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>Supplier Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Balance</th>
{{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supplier as $suppliers)
                                <tr>
                                    <td><a href="{{route('supplier.show',$suppliers->id)}}">{{$suppliers->name}}</a></td>
                                    <td>{{$suppliers->mobile}}</td>
                                    <td>{{$suppliers->email}}</td>
                                    <td>{{$suppliers->city}}</td>
                                    <td>{{$suppliers->state}}</td>
                                    <td>{{$settings['currency_position'] == 'left' ? $settings['currency'].' '.$suppliers->balance : $suppliers->balance.' '.$settings['currency']}}</td>
{{--                                    <td class="text-center">
                                        <a class="btn btn-primary btn-xs"
                                           href="{{route('supplier.edit',$suppliers->id)}}"><i class="fa fa-edit"></i></a>

                                        <span class="fa fa-trash btn btn-danger btn-xs"
                                              onclick="event.preventDefault();
                                                  if(confirm('Are you really want to delete?')){
                                                  document.getElementById('form-delete-{{$suppliers->id}}')
                                                  .submit()
                                                  }"/>
                                        <form style="display:none" id="{{'form-delete-'.$suppliers->id}}" method="post"
                                              action="{{route('supplier.destroy',$suppliers->id)}}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">Total</th>
                                <th>{{$settings['currency_position'] == 'left' ? $settings['currency'].' '.$total_balance[0]->balance : $total_balance[0]->balance.' '.$settings['currency']}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Plugins DataTable start-->
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="application/javascript">
        $(document).ready( function () {
            $('#dataTable').DataTable({
                "order": [],
                "columnDefs": [{ orderable: false, targets: [1,2,3,4] }],
            });
        });
    </script>
@endsection
