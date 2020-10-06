@extends('layouts.frontend')

@section('title') Covid19 Therapeutics Tracker (Live): {{$phase1+$phase2+$phase3}} therapeutics, {{$phase3}} in phase 3 from @endsection

@section('style')
    <style>
        .btn.focus, .btn:focus {
            outline: 0;
            box-shadow: 0 0 black;
        }
        button.btn.btn-block.btn-link {
            color: black;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <section style="margin-top: 25px">
        <div class="container text-center" {{--style="color: white"--}}>
            <h3 style="color: black">Therapeutics Tracker</h3>
            <div class="row">
                <div class="col-md-3" >
                    <div class="card" {{--style="background: #1a82c5"--}}>
                        <div class="card-header h4">
                            {{$phase1+$phase2+$phase3}}
                        </div>
                        <div class="card-body">
                            Total
                        </div>
                    </div>
                </div>
                <div class="col-md-3" >
                    <div class="card" {{--style="background: #0a6aa1"--}}>
                        <div class="card-header h4">
                            {{$phase1}}
                        </div>
                        <div class="card-body">
                            Phase 1
                        </div>
                    </div>
                </div>
                <div class="col-md-3" >
                    <div class="card" {{--style="background: #1b4b72"--}}>
                        <div class="card-header h4">
                            {{$phase2}}
                        </div>
                        <div class="card-body">
                            Phase 2
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card"   {{--style="background: #0c5460"--}}>
                        <div class="card-header h4">
                            {{$phase3}}
                        </div>
                        <div class="card-body">
                            Phase 3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin-top: 50px">
        <div class="container">
            <h4 class="text-center">Therapeutics Information</h4>
            @forelse($data as $key => $value)
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="heading{{$value->id}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left {{$key === 0 ? '': 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse{{$value->id}}" aria-expanded="{{$key === 0 ? 'true': 'false'}}" aria-controls="collapse{{$value->id}}">
                                    {{$value->tradeName}}
                                </button>
                            </h2>
                        </div>
                        <div id="collapse{{$value->id}}" class="collapse {{$key === 0 ? 'show': ''}}" aria-labelledby="heading{{$value->id}}" data-parent="#accordionExample">
                            <div class="card-body">
                                <p> <b> Last Update : </b> {{$value->lastUpdate}}</p>
                                <p> <b> Medication Class : </b> {{$value->medicationClass}}</p>
                                <p> <b>  Trade Name :</b> {{$value->tradeName}}</p>
                                <p><b>  Developer Researcher : </b>{{$value->developerResearcher}}</p>
                                <p><b>  Sponsors : </b>{{$value->sponsors}}</p>
                                <p><b>  Trial Phase : </b>{{$value->trialPhase}}</p>
                                <p><b>  Details : </b>@php echo $value->details @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3 style="color: red">There is no data available</h3>
            @endforelse
        </div>
    </section>
@endsection
