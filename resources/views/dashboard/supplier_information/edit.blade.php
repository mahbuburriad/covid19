@extends('layouts.master')
@section('title', 'Edit Supplier')

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
                        <form method="post" action="{{route('supplier.update', $supplier->id)}}">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Supplier Name <span style="color: red"> *</span></label>
                                    <input type="text" class="form-control" name="supplier_name" required value="{{$supplier-> supplier_name }}">

                                    <label class="col-form-label">Phone</label>
                                    <input type="number" class="form-control" name="phone" value="{{$supplier-> phone }}">

                                    <label class="col-form-label">Mobile</label>
                                    <input type="number" class="form-control" name="mobile" value="{{$supplier-> mobile }}">

                                    <label class="col-form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$supplier-> email }}">

                                    <label class="col-form-label">Fax</label>
                                    <input id="email" type="text" class="form-control" name="fax" value="{{$supplier-> fax }}">

                                    <label class="col-form-label">City</label>
                                    <input type="text" class="form-control" name="city" value="{{$supplier-> city }}">

                                    <label class="col-form-label">State</label>
                                    <input type="text" class="form-control" name="state" value="{{$supplier-> state }}">


                                </div>

                                <div class="form-group col-md-6">

                                    <label class="col-form-label">Zip</label>
                                    <input type="text" class="form-control" name="zip" value="{{$supplier-> zip }}">

                                    <label class="col-form-label">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{$supplier-> country }}">

                                    <label class="col-form-label">Supplier Address</label>
                                    <textarea name="address" class="form-control">{{$supplier-> address }}</textarea>

                                    <label class="col-form-label">Company Address</label>
                                    <textarea name="address2" class="form-control">{{$supplier-> address2 }}</textarea>

                                    <label class="col-form-label">Supplier Details</label>
                                    <textarea name="details" class="form-control">{{$supplier-> details }}</textarea>

                                    <label class="col-form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option {{$supplier->status == '1' ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$supplier->status == '0' ? 'selected' : ''}} value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>

                            <input type="submit" name="update" value="Update" class="btn btn-primary">
                            <input type="submit" name="save" value="Update &amp; Stay" class="btn btn-secondary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
