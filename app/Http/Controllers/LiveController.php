<?php

namespace App\Http\Controllers;

use App\Models\CountryData;
use App\Models\Data;
use App\Models\state;
use App\Models\VaccineTracker;
use App\Models\Yesterday;
use Carbon\Carbon;
use DOMDocument;
use App\Models\Live;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LiveController extends Controller
{
    public function today()
    {
        Artisan::call('view:clear');
        Live::truncate();
        $date = 'live';
        $day = 0;
        $this->getData($day, $date);
        Artisan::call('view:cache');


    }

    public function yesterday()
    {
        Artisan::call('view:cache');
        //Yesterday::truncate();
        $date = 'yesterday';
        $day = 1;
        $this->getData($day, $date);
        Artisan::call('view:cache');

    }

    private function getData($day, $date)
    {
        $url = "https://www.worldometers.info/coronavirus/";
        $html = file_get_contents($url);
        $dom = new domDocument;
        @$dom->loadHTML($html);
        $tables = $dom->getElementsByTagName('table');
        $rows = $tables->item($day)->getElementsByTagName('tr');

        $yesterdayData = DB::table('yesterdays')->latest('id')->first();

        if (!empty($yesterdayData) && $yesterdayData->date == Carbon::today() && $date == 'yesterday') {
            Yesterday::where('date', Carbon::today())->delete();
            $this->fetchDataRow($rows, $date);
            echo 'I have found date , then delete it and create';
        } else if ((empty($yesterdayData) && $date == 'yesterday') || (!empty($yesterdayData) && $yesterdayData->date != Carbon::today() && $date == 'yesterday') || (!empty($yesterdayData) && $date != 'yesterday' && $date == 'live')) {
            $this->fetchDataRow($rows, $date);
            echo "created";
        } else {
            echo "already created";
        }


    }

    private function fetchDataRow($rows, $date)
    {
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            if (is_object($cols->item(1)) || is_object($cols->item(2)) || is_object($cols->item(3)) || is_object($cols->item(4)) || is_object($cols->item(5)) || is_object($cols->item(6))
                || is_object($cols->item(7)) || is_object($cols->item(8)) || is_object($cols->item(9)) || is_object($cols->item(10)) || is_object($cols->item(11)) || is_object($cols->item(12))
                || is_object($cols->item(13)) || is_object($cols->item(14))) {
                if ($cols->item(1)->nodeValue == 'World' || !empty($cols->item(0)->nodeValue)) {
                    $country = $cols->item(1)->nodeValue;
                    $total_cases = $cols->item(2)->nodeValue;
                    $new_cases = $cols->item(3)->nodeValue;
                    $total_deaths = $cols->item(4)->nodeValue;
                    $new_deaths = $cols->item(5)->nodeValue;
                    $total_recovered = $cols->item(6)->nodeValue;
                    $new_recovered = $cols->item(7)->nodeValue;
                    $active_cases = $cols->item(8)->nodeValue;
                    $serious = $cols->item(9)->nodeValue;
                    $tot_cases = $cols->item(10)->nodeValue;
                    $death1m = $cols->item(11)->nodeValue;
                    $total_tests = $cols->item(12)->nodeValue;
                    $test1m = $cols->item(13)->nodeValue;
                    $population = $cols->item(14)->nodeValue;

                    $stringReplace = array('+', ',', ' ', 'N/A');

                    $t_case = str_replace($stringReplace, '', $total_cases);
                    if (is_numeric($t_case)) {
                        $total_cases = $t_case;
                    }

                    $n_cases = str_replace($stringReplace, '', $new_cases);
                    if (is_numeric($n_cases)) {
                        $new_cases = $n_cases;
                    }

                    $t_death = str_replace($stringReplace, '', $total_deaths);
                    if (is_numeric($t_death)) {
                        $total_deaths = $t_death;
                    }

                    $n_death = str_replace($stringReplace, '', $new_deaths);
                    if (is_numeric($n_death)) {
                        $new_deaths = $n_death;
                    }

                    $t_recovered = str_replace($stringReplace, '', $total_recovered);
                    if (is_numeric($t_recovered)) {
                        $total_recovered = $t_recovered;
                    }

                    $n_recovered = str_replace($stringReplace, '', $new_recovered);
                    if (is_numeric($n_recovered)) {
                        $new_recovered = $n_recovered;
                    }

                    $a_cases = str_replace($stringReplace, '', $active_cases);
                    if (is_numeric($a_cases)) {
                        $active_cases = $a_cases;
                    }

                    $ser = str_replace($stringReplace, '', $serious);
                    if (is_numeric($ser)) {
                        $serious = $ser;
                    }

                    $tot = str_replace($stringReplace, '', $tot_cases);
                    if (is_numeric($tot)) {
                        $tot_cases = $tot;
                    }

                    $d1m = str_replace($stringReplace, '', $death1m);
                    if (is_numeric($d1m)) {
                        $death1m = $d1m;
                    }

                    $t_tests = str_replace($stringReplace, '', $total_tests);
                    if (is_numeric($t_tests)) {
                        $total_tests = $t_tests;
                    }

                    $t1m = str_replace($stringReplace, '', $test1m);
                    if (is_numeric($t1m)) {
                        $test1m = $t1m;
                    }

                    $pop = str_replace($stringReplace, '', $population);
                    if (is_numeric($pop)) {
                        $population = $pop;
                    }


                    if ($date == 'yesterday') {
                        $this->yesterdayInsert($country, $total_cases, $new_cases, $total_deaths, $new_deaths, $total_recovered, $new_recovered, $active_cases, $serious, $tot_cases, $death1m, $total_tests, $test1m, $population);
                    } elseif ($date = 'live') {
                        $this->liveInsert($country, $total_cases, $new_cases, $total_deaths, $new_deaths, $total_recovered, $new_recovered, $active_cases, $serious, $tot_cases, $death1m, $total_tests, $test1m, $population);
                    } else {
                        echo 'date is invalid';
                    }

                }
            }
        }
    }

    private function yesterdayInsert($country, $total_cases, $new_cases, $total_deaths, $new_deaths, $total_recovered, $new_recovered, $active_cases, $serious, $tot_cases, $death1m, $total_tests, $test1m, $population)
    {
        Yesterday::create([
            'country' => $country,
            'total_cases' => $total_cases,
            'new_cases' => $new_cases,
            'total_deaths' => $total_deaths,
            'new_deaths' => $new_deaths,
            'total_recovered' => $total_recovered,
            'new_recovered' => $new_recovered,
            'active_cases' => $active_cases,
            'serious' => $serious,
            'tot_cases' => $tot_cases,
            'death1m' => $death1m,
            'total_tests' => $total_tests,
            'test1m' => $test1m,
            'population' => $population,
            'date' => Carbon::today()
        ]);
    }

    private function liveInsert($country, $total_cases, $new_cases, $total_deaths, $new_deaths, $total_recovered, $new_recovered, $active_cases, $serious, $tot_cases, $death1m, $total_tests, $test1m, $population)
    {
        Live::create([
            'country' => $country,
            'total_cases' => $total_cases,
            'new_cases' => $new_cases,
            'total_deaths' => $total_deaths,
            'new_deaths' => $new_deaths,
            'total_recovered' => $total_recovered,
            'new_recovered' => $new_recovered,
            'active_cases' => $active_cases,
            'serious' => $serious,
            'tot_cases' => $tot_cases,
            'death1m' => $death1m,
            'total_tests' => $total_tests,
            'test1m' => $test1m,
            'population' => $population
        ]);
    }


    public function data()
    {
        Artisan::call('view:clear');
        // Retrieving Json Data
        $jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
        $data = json_decode($jsonData, true);

        Data::truncate();

        foreach ($data as $key => $allData) {
            foreach ($data[$key] as $keyData) {
                $country = $key;
                $date = $keyData['date'];
                $confirm = $keyData['confirmed'];
                $recovered = $keyData['recovered'];
                $death = $keyData['deaths'];

                Data::create([
                    'country' => $country,
                    'date' => $date,
                    'confirm' => $confirm,
                    'recovered' => $recovered,
                    'death' => $death
                ]);
            }
        }
        echo "created";
        Artisan::call('view:cache');
    }

    public function bangladeshDistrictData()
    {
        Artisan::call('view:clear');
        $url = "http://dashboard.dghs.gov.bd/webportal/pages/covid19.php";
        $html = file_get_contents($url);
        $dom = new domDocument;
        @$dom->loadHTML($html);
        $tables = $dom->getElementById('example');
        $rows = $tables->getElementsByTagName('tr');

        $stateData = DB::table('states')->latest('id')->first();

        if ((empty($stateData)) || ($stateData->date != Carbon::today() && !empty($stateData))) {
            $this->insertStates($rows);
            echo "created";
        } else {
            echo "already created";
        }
        Artisan::call('view:cache');
    }

    private function insertStates($rows)
    {
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            if (is_object($cols->item(0)) || is_object($cols->item(1)) || is_object($cols->item(2))) {
                $division = $cols->item(0)->nodeValue;
                $district = $cols->item(1)->nodeValue;
                $numberOfPeople = $cols->item(2)->nodeValue;

                state::create([
                    'date' => carbon::today(),
                    'country' => 'Bangladesh',
                    'state' => $division,
                    'district' => $district,
                    'numberOfPeople' => $numberOfPeople
                ]);
            }
        }
    }

    public function vaccineInsert()
    {
        $url = "https://www.nytimes.com/interactive/2020/science/coronavirus-vaccine-tracker.html";
        $html = file_get_contents($url);
        $dom = new domDocument;
        @$dom->loadHTML($html);

        $g_ai0_6 = $dom->getElementById('g-ai0-6');
        $pre = $g_ai0_6->getElementsByTagName('p');

        $g_ai0_7 = $dom->getElementById('g-ai0-7');
        $p1 = $g_ai0_7->getElementsByTagName('p');

        $g_ai0_7 = $dom->getElementById('g-ai0-8');
        $p2 = $g_ai0_7->getElementsByTagName('p');

        $g_ai0_7 = $dom->getElementById('g-ai0-9');
        $p3 = $g_ai0_7->getElementsByTagName('p');

        $g_ai0_7 = $dom->getElementById('g-ai0-10');
        $approve = $g_ai0_7->getElementsByTagName('p');

        $site_content = $dom->getElementById('site-content');
        $times = $site_content->getElementsByTagName('time');

        $limited = null;
        $phase1 = null;
        $phase2 = null;
        $phase3 = null;
        $approval = null;
        $time = null;

        foreach ($pre as $row) {
            $phase1 = $row->nodeValue;
        }

        foreach ($p1 as $row) {
            $phase2 = $row->nodeValue;
        }

        foreach ($p2 as $row) {
            $phase3 = $row->nodeValue;
        }

        foreach ($p3 as $row) {
            $limited = $row->nodeValue;
        }

        foreach ($approve as $row) {
            $approval = $row->nodeValue;
        }

        foreach ($times as $row) {
            $time = $row->nodeValue;
        }

        $vaccine = DB::table('vaccine_trackers')->latest('id')->first();

        if ((empty($vaccine)) || ($vaccine->date != Carbon::today() && !empty($vaccine))) {
            VaccineTracker::create([
                'date' => Carbon::today(),
                'time' => $time,
                'phase1' => $phase1,
                'phase2' => $phase2,
                'phase3' => $phase3,
                'limited' => $limited,
                'approved' => $approval
            ]);
            echo "created";
        } else {
            echo "already created";
        }
    }

    public function test()
    {
        $response = Http::get('https://disease.sh/v3/covid-19/countries');

        $so = $response->json();

        foreach ($so as $s) {
            CountryData::create([
                'updated' => $s['updated'],
                'country' => $s['country'],
                'iso2' => $s['countryInfo']['iso2'],
                'iso3' => $s['countryInfo']['iso3'],
                'lat' => $s['countryInfo']['lat'],
                'long' => $s['countryInfo']['long'],
                'flag' => $s['countryInfo']['flag'],
                'cases' => $s['cases'],
                'todayCases' => $s['todayCases'],
                'deaths' => $s['deaths'],
                'todayDeaths' => $s['todayDeaths'],
                'recovered' => $s['recovered'],
                'todayRecovered' => $s['todayRecovered'],
                'active' => $s['active'],
                'critical' => $s['critical'],
                'casesPerOneMillion' => $s['casesPerOneMillion'],
                'deathsPerOneMillion' => $s['deathsPerOneMillion'],
                'tests' => $s['tests'],
                'testsPerOneMillion' => $s['testsPerOneMillion'],
                'population' => $s['population'],
                'continent' => $s['continent'],
                'oneCasePerPeople' => $s['oneCasePerPeople'],
                'oneDeathPerPeople' => $s['oneDeathPerPeople'],
                'oneTestPerPeople' => $s['oneTestPerPeople'],
                'activePerOneMillion' => $s['activePerOneMillion'],
                'recoveredPerOneMillion' => $s['recoveredPerOneMillion'],
                'criticalPerOneMillion' => $s['criticalPerOneMillion']
            ]);
        }

        /*        dd(date('Y-m-d', 1601286465242/1000));*/

        /*        dd($so[15]['countryInfo']['iso3']);*/
        return 'Thanks';
    }


}
