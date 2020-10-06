@extends('layouts.frontend')

@section('title') Covid19 Vaccine Tracker (Live): {{$vaccines[0]->phase1+$vaccines[0]->phase2+$vaccines[0]->phase3+$vaccines[0]->limited+$vaccines[0]->approved}} vaccines, {{$vaccines[0]->limited}} limited approved from @endsection

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
        <div class="container">

            <div class="row">

                <div class="col-md-12 text-center" {{--style="color: white"--}}>
                    <div class="d-md-none d-sm-block d-xs-none" style="margin-top: 35px"></div>
                    <h3 style="color: #555">Vaccine Tracker</h3>
                    <a target="_blank" style="font-size: 80%; color: #555" href="https://www.nytimes.com/interactive/2020/science/coronavirus-vaccine-tracker.html">Data Source: The
                        New York Times</a>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #75ACC8"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->phase1}}
                                </div>
                                <div class="card-body">
                                    PHASE 1 (Testing safety and dosage)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #3B89B1;"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->phase2}}
                                </div>
                                <div class="card-body">
                                    PHASE 2 (In expanded safety trials)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #006699"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->phase3}}
                                </div>
                                <div class="card-body">
                                    PHASE 3 (In large-scale efficacy tests)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" {{--style="background-color: #719D94;"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->limited}}
                                </div>
                                <div class="card-body">
                                    LIMITED (Approved for early or limited use)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-12">
                            <div class="card" {{--style="background-color: #006E59;"--}}>
                                <div class="card-header h3">
                                    {{$vaccines[0]->approved}}
                                </div>
                                <div class="card-body">
                                    APPROVED (Approved for full use)
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="margin-top: 50px">
        <div class="container">
            <h4 class="text-center">Vaccine Produce Company Information</h4>

            @forelse($data as $key => $value)
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="heading{{$value->id}}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left {{$key === 0 ? '': 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse{{$value->id}}" aria-expanded="{{$key === 0 ? 'true': 'false'}}" aria-controls="collapse{{$value->id}}">
                                {{$value->mechanism}}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{$value->id}}" class="collapse {{$key === 0 ? 'show': ''}}" aria-labelledby="heading{{$value->id}}" data-parent="#accordionExample">
                        <div class="card-body">
                            <p> <b> Candidate : </b> {{$value->candidate}}</p>
                            <p> <b>  Mechanism :</b> {{$value->mechanism}}</p>
                            <p><b>  Sponsors : </b>{{$value->sponsors}}</p>
                            <p><b>  TrialPhase : </b>{{$value->trialPhase}}</p>
                            <p><b>  Institutions : </b>{{$value->institutions}}</p>
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
