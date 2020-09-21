<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Live;
use App\Models\state;
use App\Models\Yesterday;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $topFiveAffected = $laraCollect
            ->sortByDesc('new_cases')
            ->where('country', '!=', 'World')
            ->where('new_cases', '!=', null)
            ->take(5);
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


        //top 5 country by death 1 million people
        $death1mDataCollect = $laraCollect
            ->sortByDesc('death1m')
            ->where('country', '!=', 'World')
            ->where('death1m', '!=', null)
            ->take(5);
        $death1mDataGet = null;
        foreach ($death1mDataCollect as $death){
            $death1mDataGet = $death1mDataGet.', '.$death->country;
        }
        $death1mNews = ltrim($death1mDataGet, ' ,');

        $totcase1mCollect = $laraCollect
            ->sortByDesc('tot_cases')
            ->where('country', '!=', 'World')
            ->where('tot_cases', '!=', null)
            ->take(5);

        $totCase1mDataGet = null;
        foreach ($totcase1mCollect as $total1m){
            $totCase1mDataGet = $totCase1mDataGet.', '.$total1m->country;
        }
        $total1mNews = ltrim($totCase1mDataGet, ' ,');

        $totalPopulation = DB::table('lives')
            ->select(DB::raw('sum(population) as total_population'))
            ->where('country', '!=', 'World')
            ->get();

        $ratePercentage = DB::table('lives')
            ->select(DB::raw('country, Round(((IFNULL(total_deaths, 0)*100)/total_cases), 2) as death_percent_rate, Round(((IFNULL(total_cases, 0)*100)/(IFNULL(population, 1))), 2) as total_case_percent'))
            ->where('country', '!=', 'World')
            ->get();

        $rateCollection = collect($ratePercentage);

        $deathRateData = $rateCollection
            ->sortByDesc('death_percent_rate')
            ->take(5);
        $deathRateGet = null;
        foreach ($deathRateData as $deathRate){
            $deathRateGet = $death1mDataGet.', '.$deathRate->country;
        }
        $deathRateNews = ltrim($deathRateGet, ', ');

        $totalCaseData = $rateCollection
            ->sortByDesc('total_case_percent')
            ->take(5);

        $totalCaseGet = null;
        foreach ($totalCaseData as $totalCase){
            $totalCaseGet = $totalCaseGet.', '.$totalCase->country;
        }
        $totalCaseNews = ltrim($totalCaseGet, ', ');


        return view('frontend.index', [
            'death1mNews' => $death1mNews,
            'topFive' => $topFive,
            'overCome' => $overCome,
            'overComeWithoutLossCountry' => $overComeWithoutLossCountry,
            'bdKey' => $bdKey,
            'total1mNews' => $total1mNews,
            'totalPopulation' => $totalPopulation[0]->total_population,
            'deathRateNews' => $deathRateNews,
            'totalCaseNews' => $totalCaseNews
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
