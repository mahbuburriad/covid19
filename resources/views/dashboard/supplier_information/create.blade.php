@extends('layouts.master')
@section('title', 'Add Supplier')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <p class="pull-right"><a href="{{route('supplier.index')}}">
                        <button type="button" class="btn btn-primary">Manage Supplier</button>
                    </a></p>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <x-alert/>
                        <form method="post" action="{{route('supplier.store')}}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Supplier Name <span style="color: red"> *</span></label>
                                    <input type="text" class="form-control" name="supplier_name" required>

                                    <label class="col-form-label">Phone</label>
                                    <input type="number" class="form-control" name="phone">

                                    <label class="col-form-label">Mobile</label>
                                    <input type="number" class="form-control" name="mobile">

                                    <label class="col-form-label">Email</label>
                                    <input type="email" class="form-control" name="email">

                                    <label class="col-form-label">Fax</label>
                                    <input id="email" type="text" class="form-control" name="fax">

                                    <label class="col-form-label">City</label>
                                    <input type="text" class="form-control" name="city">

                                    <label class="col-form-label">State</label>
                                    <input type="text" class="form-control" name="state">


                                </div>

                                <div class="form-group col-md-6">

                                    <label class="col-form-label">Zip</label>
                                    <input type="text" class="form-control" name="zip">

                                    <label class="col-form-label">Country</label>
                                    <input type="text" class="form-control" name="country">

                                    <label class="col-form-label">Supplier Address</label>
                                    <textarea name="address" class="form-control"></textarea>

                                    <label class="col-form-label">Company Address</label>
                                    <textarea name="address2" class="form-control"></textarea>

                                    <label class="col-form-label">Supplier Details</label>
                                    <textarea name="details" class="form-control"></textarea>

                                    <label class="col-form-label">Previous Credit Balance</label>
                                    <input type="text" class="form-control" name="previous_credit_balance">
                                </div>
                            </div>

                            <input type="submit" name="save" value="Save" class="btn btn-primary">
                            <input type="submit" name="more" value="Save &amp; Add More" class="btn btn-secondary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
