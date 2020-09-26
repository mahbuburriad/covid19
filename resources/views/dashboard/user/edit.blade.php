@extends('layouts.master')
@section('title', 'Edit User')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <p class="pull-right"><a href="{{route('user.index')}}">
                        <button type="button" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> View User
                        </button>
                    </a></p>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <x-alert/>
                        <form method="post" action="{{route('user.update', $user->id)}}">
                            @csrf
                            @method('patch')
                            <code>Email Should be Unique (One for one user)</code>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">{{ __('Name') }} <span style="color: red"> *</span></label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">{{ __('E-Mail Address') }}<span style="color: red"> *</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">{{ __('Phone') }}</label>
                                    <input  type="number" class="form-control"  name="phone" value="{{ $user->phone }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-form-label">{{ __('Position') }}</label>
                                    <input type="text" class="form-control"
                                           name="position" value="{{ $user->position }}">
                                </div>
                            </div>

                            <input type="submit" name="update" value="Update" class="btn btn-primary">
                            <input type="submit" name="more" value="Update &amp; Stay" class="btn btn-secondary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

