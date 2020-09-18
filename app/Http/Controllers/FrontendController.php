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
        $ip = request()->ip();
        $data = Live::all();
/*        $res = file_get_contents('https://www.iplocate.io/api/lookup/'.$ip);
        $res = json_decode($res);
        $ipCountry = $res->country;

        if (empty($ipCountry->country) || $ip = '127.0.0.1'){
            $ipCountry = 'Bangladesh';
        } else
            if ($ipCountry == 'United States'){
            $ipCountry = 'USA';
        } elseif ($ipCountry == 'United Kingdom'){
            $ipCountry = 'UK';
        }else{
                $ipCountry = 'Bangladesh';
            }*/

        $ipCountry = 'Bangladesh';

        $yesterday = Yesterday::where([
            'country' => $ipCountry,
            'date' => Carbon::today()
        ])->get();

        $laraCollect = collect($data);
        $topFiveAffected = $laraCollect->sortByDesc('new_cases')->skip(1)->where('new_cases', '!=', null)->take(5);
        $bangladesh = $laraCollect->where('country', $ipCountry)->all();

        $bdKey = null;
        foreach ($bangladesh as $bdId){
            $bdKey = ($bdId->id)-1;
        }

        $topC = null;
        foreach ($topFiveAffected as $top){
            $topC = $topC.', '.$top->country;
        }
        $topFive = ltrim($topC, ', ');

/*        $overComeData = Live::select('country')->where([
            ['country', '!=', 'World'],
            ['active_cases', '!=', 'N/A'],
            'active_cases' => '0'
        ])->whereColumn([['total_cases', '>' , 'total_recovered']])->get()->sortByDesc('total_cases')->take(5);*/

        $overComeData = $laraCollect
            ->where('country', '!=', 'World')
            ->where('active_cases', '!=', 'N/A')
            ->where('active_cases' , '0')
            ->sortByDesc('country')
            ->take(5);

        $overComeDataGet = null;
        foreach ($overComeData as $overC){
            $overComeDataGet = $overComeDataGet.', '.$overC->country;
        }
        $overCome = ltrim($overComeDataGet, ',');

        $overComeWithoutLoss = Live::select('country')->where([
            ['country', '!=', 'World'],
            ['active_cases', '!=', 'N/A'],
            'active_cases' => '0'
        ])->whereColumn('total_cases', 'total_recovered')->get()->sortByDesc('total_cases')->take(5);

/*        $overComeWithoutLoss = $laraCollect
            ->where('country', '!=', 'World')
            ->where('total_cases','total_recovered');*/

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
