<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Data;
use App\Models\IndiaData;
use App\Models\Live;
use App\Models\state;
use App\Models\Therapeutic;
use App\Models\UsaData;
use App\Models\Vaccine;
use App\Models\VaccineTracker;
use App\Models\Yesterday;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function check(){
        $live = Live::all();
        $yesterday = Yesterday::where('date', Carbon::today())->get();
        $continent = Continent::where('date', Carbon::today())->get();
        $usaData = UsaData::where('date', Carbon::today())->get();
        $vaccine = Vaccine::where('date', Carbon::today())->get();
        $therapeutics = Therapeutic::where('date', Carbon::today())->get();
        $indiaData = IndiaData::where('date', Carbon::today())->get();
        $stateInsert = state::where('date', Carbon::today())->get();
        $dataInsert = Data::all();
        $vaccineInsert = VaccineTracker::where('date', Carbon::today())->get();

        return view('frontend.check', compact('live', 'yesterday', 'continent', 'usaData', 'vaccine', 'therapeutics', 'indiaData', 'stateInsert', 'dataInsert', 'vaccineInsert'));
    }

    public function index()
    {
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

        if (count($yesterday) == 0){
            $yesterday = Yesterday::where([
                'country' => $ipCountry,
                'date' => Carbon::yesterday()
            ])->get();
        }

        $laraCollect = collect($data);
        $topFiveAffected = $laraCollect
            ->sortByDesc('new_cases')
            ->where('country', '!=', 'World')
            ->where('new_cases', '!=', null)
            ->take(5);
        $bangladesh = $laraCollect->where('country', $ipCountry)->all();

        $bdKey = null;
        foreach ($bangladesh as $bdId) {
            $bdKey = ($bdId->id) - 1;
        }

        $topC = null;
        foreach ($topFiveAffected as $top) {
            $topC = $topC . ', ' . $top->country;
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
            ->where('active_cases', '0')
            ->sortByDesc('country')
            ->take(5);

        $overComeDataGet = null;
        foreach ($overComeData as $overC) {
            $overComeDataGet = $overComeDataGet . ', ' . $overC->country;
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
        foreach ($overComeWithoutLoss as $overComeWithout) {
            $overComeWithoutLossData = $overComeWithoutLossData . ', ' . $overComeWithout->country;
        }
        $overComeWithoutLossCountry = ltrim($overComeWithoutLossData, ',');


        //top 5 country by death 1 million people
        $death1mDataCollect = $laraCollect
            ->sortByDesc('death1m')
            ->where('country', '!=', 'World')
            ->where('death1m', '!=', null)
            ->take(5);
        $death1mDataGet = null;
        foreach ($death1mDataCollect as $death) {
            $death1mDataGet = $death1mDataGet . ', ' . $death->country;
        }
        $death1mNews = ltrim($death1mDataGet, ' ,');

        $totcase1mCollect = $laraCollect
            ->sortByDesc('tot_cases')
            ->where('country', '!=', 'World')
            ->where('tot_cases', '!=', null)
            ->take(5);

        $totCase1mDataGet = null;
        foreach ($totcase1mCollect as $total1m) {
            $totCase1mDataGet = $totCase1mDataGet . ', ' . $total1m->country;
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
        foreach ($deathRateData as $deathRate) {
            $deathRateGet = $death1mDataGet . ', ' . $deathRate->country;
        }
        $deathRateNews = ltrim($deathRateGet, ', ');

        $totalCaseData = $rateCollection
            ->sortByDesc('total_case_percent')
            ->take(5);

        $totalCaseGet = null;
        foreach ($totalCaseData as $totalCase) {
            $totalCaseGet = $totalCaseGet . ', ' . $totalCase->country;
        }
        $totalCaseNews = ltrim($totalCaseGet, ', ');

        $vaccines = VaccineTracker::where('date', Carbon::today())->get();

        if (count($vaccines) == 0){
            $vaccines = VaccineTracker::where('date', Carbon::yesterday())->get();
        }

        $continents = Continent::where('date', Carbon::today())->get();

        if (count($continents) == 0){
            $continents = Continent::where('date', Carbon::yesterday())->get();
        }

        $continentCollection = collect($continents);
        $continentTotalCase = $continentCollection->sortByDesc('cases');

        $continentPercentage = DB::table('continents')
            ->select(DB::raw('continent, Round(((IFNULL(deaths, 0)*100)/cases), 2) as death_percent_rate, Round(((IFNULL(cases, 0)*100)/(IFNULL(population, 1))), 2) as total_case_percent'))
            ->where('date', Carbon::today())
            ->get();

        if (count($continentPercentage) == 0){
            $continentPercentage = DB::table('continents')
                ->select(DB::raw('continent, Round(((IFNULL(deaths, 0)*100)/cases), 2) as death_percent_rate, Round(((IFNULL(cases, 0)*100)/(IFNULL(population, 1))), 2) as total_case_percent'))
                ->where('date', Carbon::yesterday())
                ->get();
        }

        $conCollection = collect($continentPercentage);

        $deathContinentNews = $conCollection->sortByDesc('death_percent_rate');
        $caseContinentNews = $conCollection->sortByDesc('total_case_percent');

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
        ], compact('data', 'bangladesh', 'yesterday', 'vaccines', 'continentTotalCase', 'deathContinentNews', 'caseContinentNews'));
    }


    public function yesterday()
    {
        $bangladesh = Yesterday::where([
            'country' => 'Bangladesh',
            'date' => Carbon::today()
        ])->get();

        if (count($bangladesh) == 0){
            $bangladesh = Yesterday::where([
                'country' => 'Bangladesh',
                'date' => Carbon::yesterday()
            ])->get();
        }

        $data = Yesterday::where('date', Carbon::today())->get();



        if (count($data) == 0){
            $data = Yesterday::where('date', Carbon::yesterday())->get();
        }

        $dataCollection = collect($data);
        $data = $dataCollection->sortByDesc('new_cases');

        return view('frontend.yesterday', compact('bangladesh', 'data'));
    }

    public function country($name)
    {

        $data = Live::where('country', $name)->get();
        $yesterday = Yesterday::where([
            'country' => $name,
            'date' => Carbon::today()
        ])->get();

        if (count($yesterday) == 0){
            $yesterday = Yesterday::where([
                'country' => $name,
                'date' => Carbon::yesterday()
            ])->get();
        }

        $states = state::where([
            'country' => $name,
            'date' => Carbon::today()
        ])->get();

        if (count($states) == 0){
            $states = state::where([
                'country' => $name,
                'date' => Carbon::yesterday()
            ])->get();
        }

        $usaData = UsaData::where('date', Carbon::today())->get();

        if (count($usaData) == 0){
            $usaData = UsaData::where('date', Carbon::yesterday())->get();
        }

        $indiaData = IndiaData::where([
            'date' => Carbon::today(),
            ['state', '!=', 'total']
        ])->get();

        if (count($indiaData) == 0){
            $indiaData = IndiaData::where([
                'date' => Carbon::yesterday(),
                ['state', '!=', 'total']
            ])->get();
        }

        if ($name == 'USA') {
            $name = 'US';
        }
        $country = Data::where('country', $name)->get();

        return view('frontend.country', ['name' => $name], compact('data', 'country', 'yesterday', 'states', 'usaData', 'indiaData'));
    }


    public function vaccine()
    {
        $data = Vaccine::where('date', Carbon::today())->get();
        $vaccines = VaccineTracker::where('date', Carbon::today())->get();

        if ((count($data) == 0) && (count($vaccines) == 0)){
            $data = Vaccine::where('date', Carbon::yesterday())->get();
            $vaccines = VaccineTracker::where('date', Carbon::yesterday())->get();
        }
        return view('frontend.vaccine', compact('data', 'vaccines'));
    }

    public function therapeutics()
    {
        $data = Therapeutic::where('date', Carbon::today())->get();

        if (count($data) == 0){
            $data = Therapeutic::where('date', Carbon::yesterday())->get();
        }

        $collection = collect($data);
        $phase1 = $collection->where('trialPhase', 'Phase 1')->count();
        $phase2 = $collection->where('trialPhase', 'Phase 2')->count();
        $phase3 = $collection->where('trialPhase', 'Phase 3')->count();
        $phase2_3 = $collection->where('trialPhase', 'Phase 2/3')->count();
        $phase1_2 = $collection->where('trialPhase', 'Phase 1/2')->count();
        $phase1b = $collection->where('trialPhase', 'Phase 1b')->count();
        $phase1_2_3 = $collection->where('trialPhase', 'Phase 1/2/3')->count();
        $phase2_4 = $collection->where('trialPhase', 'Phase 2/4')->count();
        $phase2b_3 = $collection->where('trialPhase', 'Phase 2b/3')->count();

        return view('frontend.therapeutics', [
            'phase1' => $phase1 + $phase1_2 + $phase1b + $phase1_2_3,
            'phase2' => $phase2 + $phase2_3 + $phase2_4 + $phase2b_3,
            'phase3' => $phase3,
        ], compact('data'));
    }
}
