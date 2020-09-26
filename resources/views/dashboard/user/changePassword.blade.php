@extends('layouts.master')

@section('title', 'Change Password')

@section('css')
@endsection

@section('style')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <center>
                <div class="card" style="width: 40%">
                    <x-alert/>
                    <div class="card-header">
                        <h4 class="card-title mb-0">Change Password</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                                     data-toggle="card-collapse"><i
                                    class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                                                                        data-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-auto"><img class="img-70 rounded-circle" alt=""
                                                       src="{{'/storage/image/'.Auth::user()->image}}"></div>
                            <div class="col">
                                <h3 class="mb-1">{{Auth::user()->name}}</h3>
                                <p class="mb-4">{{Auth::user()->position}}</p>
                            </div>
                        </div>
                        <form method="post" action="{{route('password')}}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label">{{ __('Old Password') }}</label>
                                    <input type="password"
                                           class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword">

                                    @error('oldPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <code>Password atLeast [8 Character, a special character, one digit, one uppercase letter, one lowercase letter]</code>
                                    <br>
                                    <label class="col-form-label">{{ __('New Password') }}</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password" required
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="col-form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <input type="submit" name="save" value="Save" class="btn btn-primary"
                                   class="btn btn-primary form-control">
                        </form>
                    </div>
                </div>
            </center>
        </div>
    </div>
@endsection
