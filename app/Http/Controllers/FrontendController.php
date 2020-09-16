<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Live;
use App\Models\state;
use App\Models\Yesterday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){
        $bangladesh = Live::where('country', 'Bangladesh')->get();
        $yesterday = Yesterday::where([
            'country' => 'Bangladesh',
            'date' => Carbon::today()
        ])->get();
        $data = Live::all();
        $total = Live::where('country', 'World')->get();
/*        $topFiveAffected = Live::select('country')->where([
            ['country', '!=', 'World'],
            ['new_cases', '!=', null]
        ])->orderBY('new_cases', 'desc')->limit(5)->get();*/

        $laraCollect = collect($data);
        $topFiveAffected = $laraCollect->sortByDesc('new_cases')->skip(1)->take(5);

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

        //$topFive = DB::select("SELECT country FROM lives WHERE (country != 'World' and new_cases is not null) ORDER BY length(new_cases) DESC LIMIT 5 ");
        return view('frontend.index', [
            'topFive' => $topFive,
            'overCome' => $overCome,
            'overComeWithoutLossCountry' => $overComeWithoutLossCountry
        ], compact('total', 'data', 'bangladesh', 'yesterday'));
    }

    public function yesterday(){
        $bangladesh = Yesterday::where([
            'country' => 'Bangladesh',
            'date' => Carbon::today()
        ])->get();
        $data = Yesterday::where('date', Carbon::today())->get();
        $total = Yesterday::where([
            'country' => 'World',
            'date' => Carbon::today()
        ])->get();
        return view('frontend.yesterday', compact('bangladesh', 'total', 'data'));
    }

    public function country($data){

        $total = Live::where('country', $data)->get();
        $yesterday = Yesterday::where([
            'country' => $data,
            'date' => Carbon::today()
        ])->get();
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
