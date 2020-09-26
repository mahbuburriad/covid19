<div>
    @if(session()->has('message'))
{{--        <div class="alert alert-success mb-5">{{session()->get('message')}}</div>--}}
        <div class="alert alert-success dark alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i>
            <p>{{session()->get('message')}}</p>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    @elseif(session()->has('error'))
        {{$slot}}
        <div class="alert alert-danger mb-5">{{session()->get('error')}}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
