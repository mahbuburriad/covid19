<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Live;
use App\Models\state;
use App\Models\Yesterday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $bangladesh = Live::where('country', 'Bangladesh')->get();
        $yesterday = Yesterday::where('country', 'Bangladesh')->get();
        $data = Live::all();
        $total = $data->first()->get();
        return view('frontend.index', compact('total', 'data', 'bangladesh', 'yesterday'));
    }

    public function yesterday(){
        $bangladesh = Yesterday::where('country', 'Bangladesh')->get();
        $data = Live::all();
        $total = $data->first()->get();
        return view('frontend.yesterday', compact('bangladesh', 'total', 'data'));
    }

    public function country($data){

        $total = Live::where('country', $data)->get();
        $yesterday = Yesterday::where('country', $data)->get();
        $states = state::where([
            'country'=> $data,
            'date' => Carbon::today()
        ])->get();

        if ($data == 'USA'){
            $data = 'US';
        }
        $country = Data::where('country', $data)->get();

        return view('frontend.country', ['data' => $data], compact('total','country', 'yesterday', 'states'));
    }
}
