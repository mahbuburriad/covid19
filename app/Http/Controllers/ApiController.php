<?php

namespace App\Http\Controllers;

use App\Models\Live;
use App\Models\Yesterday;
use Carbon\Carbon;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function dataInsert($dataFor)
    {
        if ($dataFor == 'live') {
            $url = Http::get('https://disease.sh/v3/covid-19/countries?sort=cases&allowNull=true');
            $Worldurl = Http::get('https://disease.sh/v3/covid-19/all?allowNull=false');
            $worldData = $Worldurl->json();
            $data = $url->json();
            if ($url->ok() && $Worldurl->ok()){
                Live::truncate();
                $this->dataCreate($worldData, $data, $dataFor);
                echo 'created';
            } else{
                echo 'Server access failed';
            }


        } elseif ($dataFor == 'yesterday') {

            $url = Http::get('https://disease.sh/v3/covid-19/countries?yesterday=true&sort=cases&allowNull=true');
            $Worldurl = Http::get('https://disease.sh/v3/covid-19/all?yesterday=true&allowNull=false');
            $worldData = $Worldurl->json();
            $data = $url->json();

            $yesterdayData = DB::table('yesterdays')->latest('id')->first();

            if (!empty($yesterdayData) && $yesterdayData->date == Carbon::today()) {
                Yesterday::where('date', Carbon::today())->delete();
                $this->dataCreate($worldData, $data, $dataFor);
                echo 'I have found date , then delete it and create';
            } else if (empty($yesterdayData) || (!empty($yesterdayData) && $yesterdayData->date != Carbon::today())) {
                $this->dataCreate($worldData, $data, $dataFor);
                echo "created";
            } else {
                echo "already created";
            }
        }

    }

    private function dataCreate($worldData, $data, $dataFor)
    {
        if ($dataFor == 'live') {

            Live::create([
                'updated' => $worldData['updated'],
                'country' => 'World',
                'total_cases' => $worldData['cases'],
                'new_cases' => $worldData['todayCases'],
                'total_deaths' => $worldData['deaths'],
                'new_deaths' => $worldData['todayDeaths'],
                'total_recovered' => $worldData['recovered'],
                'new_recovered' => $worldData['todayRecovered'],
                'active_cases' => $worldData['active'],
                'serious' => $worldData['critical'],
                'tot_cases' => $worldData['casesPerOneMillion'],
                'death1m' => $worldData['deathsPerOneMillion'],
                'total_tests' => $worldData['tests'],
                'test1m' => $worldData['testsPerOneMillion'],
                'population' => $worldData['population'],
                'continent' => 'World',
                'oneCasePerPeople' => $worldData['oneCasePerPeople'],
                'oneDeathPerPeople' => $worldData['oneDeathPerPeople'],
                'oneTestPerPeople' => $worldData['oneTestPerPeople'],
                'activePerOneMillion' => $worldData['activePerOneMillion'],
                'recoveredPerOneMillion' => $worldData['recoveredPerOneMillion'],
                'criticalPerOneMillion' => $worldData['criticalPerOneMillion']
            ]);


            foreach ($data as $dataGet) {
                Live::create([
                    'updated' => $dataGet['updated'],
                    'country' => $dataGet['country'],
                    'iso2' => $dataGet['countryInfo']['iso2'],
                    'iso3' => $dataGet['countryInfo']['iso3'],
                    'lat' => $dataGet['countryInfo']['lat'],
                    'long' => $dataGet['countryInfo']['long'],
                    'flag' => $dataGet['countryInfo']['flag'],
                    'total_cases' => $dataGet['cases'],
                    'new_cases' => $dataGet['todayCases'],
                    'total_deaths' => $dataGet['deaths'],
                    'new_deaths' => $dataGet['todayDeaths'],
                    'total_recovered' => $dataGet['recovered'],
                    'new_recovered' => $dataGet['todayRecovered'],
                    'active_cases' => $dataGet['active'],
                    'serious' => $dataGet['critical'],
                    'tot_cases' => $dataGet['casesPerOneMillion'],
                    'death1m' => $dataGet['deathsPerOneMillion'],
                    'total_tests' => $dataGet['tests'],
                    'test1m' => $dataGet['testsPerOneMillion'],
                    'population' => $dataGet['population'],
                    'continent' => $dataGet['continent'],
                    'oneCasePerPeople' => $dataGet['oneCasePerPeople'],
                    'oneDeathPerPeople' => $dataGet['oneDeathPerPeople'],
                    'oneTestPerPeople' => $dataGet['oneTestPerPeople'],
                    'activePerOneMillion' => $dataGet['activePerOneMillion'],
                    'recoveredPerOneMillion' => $dataGet['recoveredPerOneMillion'],
                    'criticalPerOneMillion' => $dataGet['criticalPerOneMillion']
                ]);
            }
        }


        if ($dataFor == 'yesterday') {

            Yesterday::create([
                'date' => Carbon::today(),
                'updated' => $worldData['updated'],
                'country' => 'World',
                'total_cases' => $worldData['cases'],
                'new_cases' => $worldData['todayCases'],
                'total_deaths' => $worldData['deaths'],
                'new_deaths' => $worldData['todayDeaths'],
                'total_recovered' => $worldData['recovered'],
                'new_recovered' => $worldData['todayRecovered'],
                'active_cases' => $worldData['active'],
                'serious' => $worldData['critical'],
                'tot_cases' => $worldData['casesPerOneMillion'],
                'death1m' => $worldData['deathsPerOneMillion'],
                'total_tests' => $worldData['tests'],
                'test1m' => $worldData['testsPerOneMillion'],
                'population' => $worldData['population'],
                'continent' => 'World',
                'oneCasePerPeople' => $worldData['oneCasePerPeople'],
                'oneDeathPerPeople' => $worldData['oneDeathPerPeople'],
                'oneTestPerPeople' => $worldData['oneTestPerPeople'],
                'activePerOneMillion' => $worldData['activePerOneMillion'],
                'recoveredPerOneMillion' => $worldData['recoveredPerOneMillion'],
                'criticalPerOneMillion' => $worldData['criticalPerOneMillion']
            ]);


            foreach ($data as $dataGet) {
                Yesterday::create([
                    'date' => Carbon::today(),
                    'updated' => $dataGet['updated'],
                    'country' => $dataGet['country'],
                    'iso2' => $dataGet['countryInfo']['iso2'],
                    'iso3' => $dataGet['countryInfo']['iso3'],
                    'lat' => $dataGet['countryInfo']['lat'],
                    'long' => $dataGet['countryInfo']['long'],
                    'flag' => $dataGet['countryInfo']['flag'],
                    'total_cases' => $dataGet['cases'],
                    'new_cases' => $dataGet['todayCases'],
                    'total_deaths' => $dataGet['deaths'],
                    'new_deaths' => $dataGet['todayDeaths'],
                    'total_recovered' => $dataGet['recovered'],
                    'new_recovered' => $dataGet['todayRecovered'],
                    'active_cases' => $dataGet['active'],
                    'serious' => $dataGet['critical'],
                    'tot_cases' => $dataGet['casesPerOneMillion'],
                    'death1m' => $dataGet['deathsPerOneMillion'],
                    'total_tests' => $dataGet['tests'],
                    'test1m' => $dataGet['testsPerOneMillion'],
                    'population' => $dataGet['population'],
                    'continent' => $dataGet['continent'],
                    'oneCasePerPeople' => $dataGet['oneCasePerPeople'],
                    'oneDeathPerPeople' => $dataGet['oneDeathPerPeople'],
                    'oneTestPerPeople' => $dataGet['oneTestPerPeople'],
                    'activePerOneMillion' => $dataGet['activePerOneMillion'],
                    'recoveredPerOneMillion' => $dataGet['recoveredPerOneMillion'],
                    'criticalPerOneMillion' => $dataGet['criticalPerOneMillion']
                ]);
            }
        }
    }
}
