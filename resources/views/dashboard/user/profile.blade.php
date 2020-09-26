@extends('layouts.master')

@section('title', 'Profile Page')

@section('css')
@endsection

@section('style')
@endsection
@section('content')
    @if(!(session()->has('message')))
    <div style="margin-top: 100px"></div>
    @endif
    <div class="container-fluid">
        <div class="edit-profile">
<center>
                    <div class="card" style="width: 40%">
                        <x-alert/>
                        <div class="card-header">
                            <h4 class="card-title mb-0">My Profile</h4>
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
                            <form method="post" action="{{route('profileChange')}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="Your Name" name="name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" value="{{Auth::user()->email}}" placeholder="Your Email Address" name="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value="{{Auth::user()->position}}" placeholder="Your Position" name="position">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Theme</label>
                                    <select name="theme" class="form-control" required>
                                        <option {{Auth::user()->theme == 'box' ? 'selected' : ''}} value="box">Box</option>
                                        <option {{Auth::user()->theme == 'compact' ? 'selected' : ''}} value="compact">Compact</option>
                                        <option {{Auth::user()->theme == 'compact_dark' ? 'selected' : ''}} value="compact_dark">Compact Dark</option>
                                        <option {{Auth::user()->theme == 'compact_rtl' ? 'selected' : ''}} value="compact_rtl">Compact RTL</option>
                                        <option {{Auth::user()->theme == 'dark' ? 'selected' : ''}} value="dark">Dark</option>
                                        <option {{Auth::user()->theme == 'dark_box' ? 'selected' : ''}} value="dark_box">Dark Box</option>
                                        <option {{Auth::user()->theme == 'dark_rtl' ? 'selected' : ''}} value="dark_rtl">Dark RTL</option>
                                        <option {{Auth::user()->theme == 'light' ? 'selected' : ''}} value="light">Light</option>
                                        <option {{Auth::user()->theme == 'rtl' ? 'selected' : ''}} value="rtl">RTL</option>
                                        <option {{Auth::user()->theme == 'vertical' ? 'selected' : ''}} value="vertical">Vertical</option>
                                        <option {{Auth::user()->theme == 'vertical_box' ? 'selected' : ''}} value="vertical_box">Vertical Box</option>
                                        <option {{Auth::user()->theme == 'vertical_rtl' ? 'selected' : ''}} value="vertical_rtl">Vertical RTL</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Sidebar</label>
                                    <select name="sidebar" class="form-control" required>
                                        <option {{Auth::user()->sidebar == 'light-sidebar' ? 'selected' : ''}} value="light-sidebar">Light Sidebar</option>
                                        <option {{Auth::user()->sidebar == 'dark-sidebar' ? 'selected' : ''}} value="dark-sidebar">Dark Sidebar</option>
                                        <option {{Auth::user()->sidebar == 'dark-header-sidebar-mix' ? 'selected' : ''}} value="dark-header-sidebar-mix">Dark Header Sidebar Mix</option>
                                    </select>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" name="save" class="btn btn-primary btn-block">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
</center>
        </div>
    </div>
@endsection
