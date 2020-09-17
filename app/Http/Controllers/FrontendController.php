<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Live;
use App\Models\state;
use App\Models\Yesterday;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index(){
        $yesterday = Yesterday::where([
            'country' => 'Bangladesh',
            'date' => Carbon::today()
        ])->get();
        $data = Live::all();

        $laraCollect = collect($data);
        $topFiveAffected = $laraCollect->sortByDesc('new_cases')->skip(1)->where('new_cases', '!=', null)->take(5);
        $bangladesh = $laraCollect->where('country', 'Bangladesh')->all();

        $bdKey = null;
        foreach ($bangladesh as $bdId){
            $bdKey = ($bdId->id)-1;
        }

        $topC = null;
        foreach ($topFiveAffected as $top){
            $topC = $topC.', '.$top->country;
        }
        $topFive = ltrim($topC, ', ');

        $overComeData = Live::select('country')->where([
            ['country', '!=', 'World'],
            ['active_cases', '!=', 'N/A'],
            'active_cases' => '0'
        ])->orderBy('new_cases', 'desc')->get();

        $overComeDataGet = null;
        foreach ($overComeData as $overC){
            $overComeDataGet = $overComeDataGet.', '.$overC->country;
        }
        $overCome = ltrim($overComeDataGet, ',');

        $overComeWithoutLoss = Live::select('country')->where([
            ['country', '!=', 'World']
        ])->whereColumn('total_cases', 'total_recovered')->orderBy('total_cases', 'desc')->get();

        $overComeWithoutLossData = null;
        foreach ($overComeWithoutLoss as $overComeWithout){
            $overComeWithoutLossData = $overComeWithoutLossData.', '.$overComeWithout->country;
        }
        $overComeWithoutLossCountry = ltrim($overComeWithoutLossData, ',');

        return view('frontend.index', [
            'topFive' => $topFive,
            'overCome' => $overCome,
            'overComeWithoutLossCountry' => $overComeWithoutLossCountry,
            'bdKey' => $bdKey
        ], compact('data', 'bangladesh', 'yesterday'));
    }

    public function yesterday(){
        $bangladesh = Yesterday::where([
            'country' => 'Bangladesh',
            'date' => Carbon::today()
        ])->get();
        $data = Yesterday::where('date', Carbon::today())->get();

        return view('frontend.yesterday', compact('bangladesh',  'data'));
    }

    public function country($name){

        $data = Live::where('country', $name)->get();
        $yesterday = Yesterday::where([
            'country' => $name,
            'date' => Carbon::today()
        ])->get();
        $states = state::where([
            'country'=> $name,
            'date' => Carbon::today()
        ])->get();

        if ($name == 'USA'){
            $name = 'US';
        }
        $country = Data::where('country', $name)->get();

        return view('frontend.country', ['name' => $name], compact('data','country', 'yesterday', 'states'));
    }
}
