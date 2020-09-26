@extends('layouts.master')
@section('title', '| Settings')

@section('css')
    {{--    File Upload Css--}}
    <link href="{{asset('assets/plugins/fileuploads/css/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Website Settings</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-spin fa-cog"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-alert/>
{{--                        <h4 style="color: #007bff" class="m-t-0 header-title">Website Settings</h4>--}}

                        <form method="post" action="{{route('settingsUpdate', 'data')}}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Website Title</label>
                                    <input type="text" name="data[website_title]" class="form-control"
                                           value="{{$settings->website_title}}">

                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Website Email</label>
                                    <input type="text" name="data[website_email]" class="form-control"
                                           value="{{$settings->website_email}}">

                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Address</label>
                                    <input type="text" name="data[address]" class="form-control"
                                           value="{{$settings->address}}">
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Mobile</label>
                                            <input type="text" name="data[mobile]" class="form-control"
                                                   value="{{$settings->mobile}}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Website</label>
                                            <input type="text" name="data[website]" class="form-control"
                                                   value="{{$settings->website}}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Footer Text Left</label>
                                            <input type="text" name="data[footer_text_left]" class="form-control"
                                                   value="{{$settings->footer_text_left}}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label">Footer Text Right</label>
                                            <input type="text" name="data[footer_text_right]" class="form-control"
                                                   value="{{$settings->footer_text_right}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Website Logo</label>
                                    <input type="file" class="dropify" name="logo"
                                           data-default-file="{{'/storage/image/'.$settings->logo}}" accept="image/*">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Website Favicon</label>
                                    <input type="file" class="dropify" name="favicon"
                                           data-default-file="{{'/storage/image/'.$settings->favicon}}" accept="image/*">
                                </div>
                            </div>

                            <input type="submit" name="submit" value="Save Settings" class="btn btn-primary"
                                   class="btn btn-primary form-control">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- file uploads js -->
    <script src="{{asset('assets/plugins/fileuploads/js/dropify.min.js')}}"></script>
    <script type="text/javascript">
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (1M max).'
            }
        });
    </script>
@endsection
