@extends('layouts.master')
@section('title', 'User List')

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
                <p class="pull-right"><a href="{{route('user.create')}}">
                        <button type="button" class="btn btn-primary"> <i class="fa fa-arrow-right"></i> Create User
                        </button>
                    </a></p>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Position</th>
                                <th class="text-center">Modification</th>
                            </tr>
                            </thead>
                            <tbody>
                            <x-alert/>
                            @foreach($admin as $admins)
                                <tr>
                                    <td>{{$admins->name}}</td>
                                    <td> @if($admins->email != 'demo@test.com')
                                            {{$admins->email}}
                                        @else
                                            {{$admins->email}} <span
                                                class="badge badge-success pull-right">Default</span>
                                        @endif
                                    </td>
                                    <td>{{$admins->phone}}</td>
                                    <td>{{$admins->position}}</td>

                                    <td class="text-center">
                                        @if($admins->email != 'demo@test.com')
                                            <a class="btn btn-primary waves-effect waves-light m-r-5 m-b-10"
                                               href="{{route('user.edit',$admins->id)}}"><i class="fa fa-edit"></i></a>
                                        @if($admins->id != Auth::user()->id)
                                            <span
                                                class="fa fa-trash btn btn-danger waves-effect waves-light m-r-5 m-b-10"
                                                onclick="event.preventDefault();
                                                    if(confirm('Are you really want to delete?')){
                                                    document.getElementById('form-delete-{{$admins->id}}')
                                                    .submit()
                                                    }"/>
                                            @endif
                                            <form style="display:none" id="{{'form-delete-'.$admins->id}}" method="post"
                                                  action="{{route('user.destroy',$admins->id)}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @else
                                            <span class="alert alert-danger">Not Changable</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
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
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script type="application/javascript">
        $(document).ready( function () {
            $('#dataTable').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
