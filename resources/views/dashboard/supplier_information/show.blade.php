@extends('layouts.master')
@section('title', $supplier->supplier_name)

@section('css')
    {{--    Datatable CSS--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
    <style>
        .delete_li {
            font-size: 13px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <x-alert/>
                        <div class="row list-persons" id="addcon">
                            <div class="col-md-8">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                                        <div class="profile-mail">
                                            <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_0"  alt="">
                                                <input class="updateimg" type="file" name="img" onchange="readURL(this,0)">
                                                <div class="media-body mt-0">
                                                    <h5>{{$supplier->supplier_name}}</h5>
                                                    <p class="email_add_0">{{$supplier->email}}</p>
                                                    <ul>
                                                        <li><a href="{{route('supplier.edit', $supplier->id)}}">Edit</a></li>
                                                        <li><a href="#" onclick="printDiv();">Print</a></li>
                                                        <li><span class="font-primary delete_li" onclick="event.preventDefault();
                                                                if(confirm('Are you really want to delete?')){
                                                                document.getElementById('form-delete-{{$supplier->id}}')
                                                                .submit()
                                                                }">Delete</span></li>
                                                        <form style="display:none" id="{{'form-delete-'.$supplier->id}}" method="post"
                                                              action="{{route('supplier.destroy',$supplier->id)}}">
                                                            @csrf
                                                            @method('delete')
                                                        </form>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="email-general" id="DivIdToPrint">
                                                <h6 class="mb-3">Supplier Information</h6>
                                                <ul>
                                                    <li>Name: <span class="font-primary first_name_0">{{$supplier->supplier_name}}</span></li>
                                                    <li>Mobile: <span class="font-primary">{{$supplier->mobile}}</span></li>
                                                    <li>Phone: <span class="font-primary">{{$supplier->phone}}</span></li>
                                                    <li>Email Address: <span class="font-primary personality_0">{{$supplier->email}}</span></li>
                                                    <li>City: <span class="font-primary city_0">{{$supplier->city}}</span></li>
                                                    <li>State: <span class="font-primary city_0">{{$supplier->state}}</span></li>
                                                    <li>Country: <span class="font-primary city_0">{{$supplier->country}}</span></li>
                                                    <li>Fax: <span class="font-primary mobile_num_0">{{$supplier->fax}}</span></li>
                                                    <li>Supplier Address: <span class="font-primary email_add_0">{{$supplier->address}} </span></li>
                                                    <li>Company Address: <span class="font-primary url_add_0">{{$supplier->address2}}</span></li>
                                                    <li>Zip: <span class="font-primary interest_0">{{$supplier->zip}}</span></li>
                                                    <li>Details: <span class="font-primary interest_0">{{$supplier->details}}</span></li>
                                                    <li>Status: <span class="font-primary interest_0">{{$supplier->status == '1' ? 'Active' : 'Deactive'}}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(count($account_transaction) != 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>{{$supplier->supplier_name}} Ledger</h4>
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Voucher No</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($account_transaction as $transaction)
                                    <tr>
                                        <td>{{$transaction->voucher_date}}</td>
                                        <td>{{$transaction->voucher_type}}</td>
                                        <td>{{$transaction->voucher_no}}</td>
                                        <td>{{$settings['currency_position'] == 'left' ? $settings['currency'].' '.$transaction->debit : $transaction->debit.' '.$settings['currency']}}</td>
                                        <td>{{$settings['currency_position'] == 'left' ? $settings['currency'].' '.$transaction->credit : $transaction->credit.' '.$settings['currency']}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right font-weight-bolder">Total</td>
                                    <td class="font-weight-bolder">{{$settings['currency_position'] == 'left' ? $settings['currency'].' '.$total_debit[0]->debit : $total_debit[0]->debit.' '.$settings['currency']}}</td>
                                    <td class="font-weight-bolder">{{$settings['currency_position'] == 'left' ? $settings['currency'].' '.$total_credit[0]->credit : $total_credit[0]->credit.' '.$settings['currency']}}</td>
                                </tr>
                                </tbody>


                                <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Balance</th>
                                    <th>{{$settings['currency_position'] == 'left' ? $settings['currency'].' '.($total_debit[0]->debit - $total_credit[0]->credit) : ($total_debit[0]->debit - $total_credit[0]->credit).' '.$settings['currency']}}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <!-- Plugins DataTable start-->
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>

    <script type="application/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                order: [],
                columnDefs: [{orderable: false, targets: [1, 2]}],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        titleAttr: 'Copy',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',
                        footer: true
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        footer: true
                    }
                ]
            });
        });
    </script>

    <script src="{{asset('assets/js/contacts/custom.js')}}"></script>

@endsection
