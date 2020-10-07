<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>CronJob Check</title>
</head>
<body>
<div class="container">


<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Route</th>
            <th scope="col">update</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><a target="_blank" href="{{route('dataGet', 'live')}}"><button class="btn  {{date('Y-m-d 00:00:00', strtotime($live[0]->updated_at)) == Carbon\Carbon::today() ? 'btn-success' : 'btn-danger'}}">Live</button></a></td>
            <td>{{$live[0]->updated_at->diffForHumans()}}</td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('dataGet', 'yesterday')}}"><button class="btn {{count($yesterday) != 0 ? 'btn-success' : 'btn-danger'}}">Yesterday</button></a></td>
            <td>{{count($yesterday) != 0 ? $yesterday[0]->updated_at->diffForHumans() : ''}}</td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('dataGet', 'continent')}}"><button class="btn {{count($continent) != 0 ? 'btn-success' : 'btn-danger'}}">continent</button></a></td>
            <td>{{count($continent) != 0 ? $continent[0]->updated_at->diffForHumans() : ''}}</td>
        </tr>
        <tr>
            <td><a target="_blank" href="{{route('dataGet', 'usaData')}}"><button class="btn {{count($usaData) != 0 ? 'btn-success' : 'btn-danger'}}">usaData</button></a></td>
            <td>{{count($usaData) != 0 ? $usaData[0]->updated_at->diffForHumans() : ''}}</td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('dataGet', 'vaccine')}}"><button class="btn {{count($vaccine) != 0 ? 'btn-success' : 'btn-danger'}}">vaccine Information</button></a></td>
            <td>{{count($vaccine) != 0 ? $vaccine[0]->updated_at->diffForHumans() : ''}}</td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('dataGet', 'therapeutics')}}"><button class="btn {{count($therapeutics) != 0 ? 'btn-success' : 'btn-danger'}}">therapeutics</button></a></td>
            <td>{{count($therapeutics) != 0 ? $therapeutics[0]->updated_at->diffForHumans() : ''}}</td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('dataGet', 'indiaData')}}"><button class="btn {{count($indiaData) != 0 ? 'btn-success' : 'btn-danger'}}">indiaData</button></a></td>
            <td>{{count($indiaData) != 0 ? $indiaData[0]->updated_at->diffForHumans() : ''}}</td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('bangladeshDistrictData')}}"><button class="btn {{count($stateInsert) != 0 ? 'btn-success' : 'btn-danger'}}">stateInsert</button></a> </td>
            <td>{{count($stateInsert) != 0 ? $stateInsert[0]->updated_at->diffForHumans() : ''}}</td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('data')}}"><button class="btn {{date('Y-m-d 00:00:00', strtotime($dataInsert[0]->updated_at)) == Carbon\Carbon::today() ? 'btn-success' : 'btn-danger'}}">DataInsert</button></a> </td>
            <td>{{count($dataInsert) != 0 ? $dataInsert[0]->updated_at->diffForHumans() : ''}} </td>
        </tr>

        <tr>
            <td><a target="_blank" href="{{route('vaccineInsert')}}"><button class="btn {{count($vaccineInsert) != 0 ? 'btn-success' : 'btn-danger'}}">vaccineInsert</button></a> </td>
            <td>{{count($vaccineInsert) != 0 ? $vaccineInsert[0]->updated_at->diffForHumans() : ''}} </td>
        </tr>

        </tbody>
    </table>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
