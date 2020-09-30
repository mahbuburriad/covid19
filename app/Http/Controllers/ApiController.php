<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Live;
use App\Models\Therapeutic;
use App\Models\UsaData;
use App\Models\Vaccine;
use App\Models\Yesterday;
use Carbon\Carbon;
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
            if ($url->ok() && $Worldurl->ok()) {
                Live::truncate();
                $this->dataCreate($worldData, $data, $dataFor);
                echo 'created';
            } else {
                echo 'Server access failed';
            }


        } elseif ($dataFor == 'yesterday') {

            $url = Http::get('https://disease.sh/v3/covid-19/countries?yesterday=true&sort=cases&allowNull=true');
            $Worldurl = Http::get('https://disease.sh/v3/covid-19/all?yesterday=true&allowNull=false');
            $worldData = $Worldurl->json();
            $data = $url->json();

            if ($url->ok() && $Worldurl->ok()) {

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
            } else {
                echo 'Server access failed';
            }
        } else if ($dataFor == 'continent') {
            $url = Http::get('https://disease.sh/v3/covid-19/continents?sort=cases&allowNull=true');
            $data = $url->json();

            $continentData = DB::table('continents')->latest('id')->first();

            if (!empty($continentData) && $continentData->date == Carbon::today()) {
                Continent::where('date', Carbon::today())->delete();
                $this->continentInsert($data);
                echo 'I have found date , then delete it and create';
            } else if (empty($continentData) || (!empty($continentData) && $continentData->date != Carbon::today())) {
                $this->continentInsert($data);
                echo "created";
            } else {
                echo "already created";
            }
        } elseif ($dataFor == 'usaData') {
            $url = Http::get('https://disease.sh/v3/covid-19/states?sort=cases&allowNull=true');
            $data = $url->json();

            $usaData = DB::table('usa_data')->latest('id')->first();

            if (!empty($usaData) && $usaData->date == Carbon::today()) {
                UsaData::where('date', Carbon::today())->delete();
                $this->usaDataInsert($data);
                echo 'I have found date , then delete it and create';
            } else if (empty($usaData) || (!empty($usaData) && $usaData->date != Carbon::today())) {
                $this->usaDataInsert($data);
                echo "created";
            } else {
                echo "already created";
            }
        } elseif ($dataFor == 'vaccine') {
            $url = Http::get('https://disease.sh/v3/covid-19/vaccine');
            $data = $url->json();

            $vaccineData = DB::table('vaccines')->latest('id')->first();

            if (!empty($vaccineData) && $vaccineData->date == Carbon::today()) {
                Vaccine::where('date', Carbon::today())->delete();
                $this->vaccine($data);
                echo 'I have found date , then delete it and create';
            } else if (empty($vaccineData) || (!empty($vaccineData) && $vaccineData->date != Carbon::today())) {
                $this->vaccine($data);
                echo "created";
            } else {
                echo "already created";
            }
        } elseif ($dataFor == 'therapeutics') {
            $url = Http::get('https://disease.sh/v3/covid-19/therapeutics');
            $data = $url->json();

            $therapeutics = DB::table('therapeutics')->latest('id')->first();

            if (!empty($therapeutics) && $therapeutics->date == Carbon::today()) {
                Therapeutic::where('date', Carbon::today())->delete();
                $this->therapeutics($data);
                echo 'I have found date , then delete it and create';
            } else if (empty($therapeutics) || (!empty($therapeutics) && $therapeutics->date != Carbon::today())) {
                $this->therapeutics($data);
                echo "created";
            } else {
                echo "already created";
            }

        } else {
            echo 'wrong Insertion';
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

    private function continentInsert($data)
    {
        foreach ($data as $value) {
            Continent::create([
                'date' => Carbon::today(),
                'updated' => $value['updated'],
                'cases' => $value['cases'],
                'todayCases' => $value['todayCases'],
                'deaths' => $value['deaths'],
                'todayDeaths' => $value['todayDeaths'],
                'recovered' => $value['recovered'],
                'todayRecovered' => $value['todayRecovered'],
                'active' => $value['active'],
                'critical' => $value['critical'],
                'casesPerOneMillion' => $value['casesPerOneMillion'],
                'deathsPerOneMillion' => $value['deathsPerOneMillion'],
                'tests' => $value['tests'],
                'testsPerOneMillion' => $value['testsPerOneMillion'],
                'population' => $value['population'],
                'continent' => $value['continent'],
                'activePerOneMillion' => $value['activePerOneMillion'],
                'recoveredPerOneMillion' => $value['recoveredPerOneMillion'],
                'criticalPerOneMillion' => $value['criticalPerOneMillion'],
                'lat' => $value['continentInfo']['lat'],
                'long' => $value['continentInfo']['long'],
                'countries' => implode(',', $value['countries']),
            ]);

        }
    }

    private function usaDataInsert($data)
    {
        foreach ($data as $value) {
            UsaData::create([
                'updated' => $value['updated'],
                'todayCases' => $value['todayCases'],
                'deaths' => $value['deaths'],
                'todayDeaths' => $value['todayDeaths'],
                'active' => $value['active'],
                'casesPerOneMillion' => $value['casesPerOneMillion'],
                'deathsPerOneMillion' => $value['deathsPerOneMillion'],
                'tests' => $value['tests'],
                'testsPerOneMillion' => $value['testsPerOneMillion'],
                'population' => $value['population'],
                'state' => $value['state'],
                'cases' => $value['cases'],
                'date' => Carbon::today()
            ]);
        }
    }

    private function vaccine($data)
    {
        foreach ($data['data'] as $value) {
            Vaccine::create([
                'date' => Carbon::today(),
                'candidate' => $value['candidate'],
                'mechanism' => $value['mechanism'],
                'sponsors' => implode(',', $value['sponsors']),
                'details' => $value['details'],
                'trialPhase' => $value['trialPhase'],
                'institutions' => implode(', ', $value['institutions'])
            ]);
        }
    }

    private function therapeutics($data)
    {
        foreach ($data['data'] as $value) {
            Therapeutic::create([
                'date' => Carbon::today(),
                'medicationClass' => $value['medicationClass'],
                'tradeName' => implode(',', $value['tradeName']),
                'details' => $value['details'],
                'developerResearcher' => implode(',', $value['developerResearcher']),
                'sponsors' => implode(',', $value['sponsors']),
                'trialPhase' => $value['trialPhase'],
                'lastUpdate' => $value['lastUpdate']
            ]);
        }
    }
}
