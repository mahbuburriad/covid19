<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Yesterday;
use DOMDocument;
use Illuminate\Http\Request;
use App\Models\Live;
use function GuzzleHttp\Psr7\str;

class LiveController extends Controller
{
    public function today()
    {
        $url = "https://www.worldometers.info/coronavirus/";
        $html = file_get_contents($url);
        $dom = new domDocument;
        @$dom->loadHTML($html);
        $tables = $dom->getElementsByTagName('table');
        $rows = $tables->item(0)->getElementsByTagName('tr');

        Live::truncate();

        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            if (is_object($cols->item(1)) || is_object($cols->item(2)) || is_object($cols->item(3)) || is_object($cols->item(4)) || is_object($cols->item(5)) || is_object($cols->item(6))
                || is_object($cols->item(7)) || is_object($cols->item(8)) || is_object($cols->item(9)) || is_object($cols->item(10)) || is_object($cols->item(11)) || is_object($cols->item(12))
                || is_object($cols->item(13)) || is_object($cols->item(14))) {
            if ( $cols->item(1)->nodeValue == 'World'  || !empty($cols->item(0)->nodeValue)) {
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
                    if (is_numeric($t_case) || empty($t_case)){
                        $total_cases = $t_case;
                    }

                    $n_cases = str_replace($stringReplace, '', $new_cases);
                    if (is_numeric($n_cases) || empty($n_cases)){
                        $new_cases = $n_cases;
                    }

                    $t_death = str_replace($stringReplace,'', $total_deaths);
                    if (is_numeric($t_death) || empty($t_death)){
                        $total_deaths = $t_death;
                    }

                    $n_death = str_replace($stringReplace, '', $new_deaths);
                    if (is_numeric($n_death) || empty($n_death)){
                        $new_deaths = $n_death;
                    }

                    $t_recovered = str_replace($stringReplace, '', $total_recovered);
                    if (is_numeric($t_recovered) || empty($t_recovered)){
                        $total_recovered = $t_recovered;
                    }

                    $n_recovered = str_replace($stringReplace, '', $new_recovered);
                    if (is_numeric($n_recovered) || empty($n_recovered)){
                        $new_recovered = $n_recovered;
                    }

                    $a_cases = str_replace($stringReplace, '', $active_cases);
                    if (is_numeric($a_cases) || empty($a_cases)){
                        $active_cases = $a_cases;
                    }

                    $ser = str_replace($stringReplace, '', $serious);
                    if (is_numeric($ser) || empty($ser)){
                        $serious = $ser;
                    }

                    $tot = str_replace($stringReplace, '', $tot_cases);
                    if (is_numeric($tot) || empty($tot)){
                        $tot_cases = $tot;
                    }

                    $d1m = str_replace($stringReplace, '', $death1m);
                    if (is_numeric($d1m) || empty($d1m)){
                        $death1m = $d1m;
                    }

                    $t_tests = str_replace($stringReplace, '', $total_tests);
                    if (is_numeric($t_tests) || empty($t_tests)){
                        $total_tests = $t_tests;
                    }

                    $t1m = str_replace($stringReplace, '', $test1m);
                    if (is_numeric($t1m) || empty($t1m)){
                        $test1m = $t1m;
                    }

                    $pop= str_replace($stringReplace, '', $population);
                    if (is_numeric($pop) || empty($pop)){
                        $population = $pop;
                    }



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
            }
        }

        echo "created";
    }

    public function yesterday()
    {
        $url = "https://www.worldometers.info/coronavirus/";
        $html = file_get_contents($url);
        $dom = new domDocument;
        @$dom->loadHTML($html);
        $tables = $dom->getElementsByTagName('table');
        $rows = $tables->item(1)->getElementsByTagName('tr');

        Live::truncate();

        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            if (is_object($cols->item(1)) || is_object($cols->item(2)) || is_object($cols->item(3)) || is_object($cols->item(4)) || is_object($cols->item(5)) || is_object($cols->item(6))
                || is_object($cols->item(7)) || is_object($cols->item(8)) || is_object($cols->item(9)) || is_object($cols->item(10)) || is_object($cols->item(11)) || is_object($cols->item(12))
                || is_object($cols->item(13)) || is_object($cols->item(14))) {
                if ( $cols->item(1)->nodeValue == 'World'  || !empty($cols->item(0)->nodeValue)) {
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

                    $stringReplace = array('+', ',', ' ');

                    $t_case = str_replace($stringReplace, '', $total_cases);
                    if (is_numeric($t_case)){
                        $total_cases = $t_case;
                    }

                    $n_cases = str_replace($stringReplace, '', $new_cases);
                    if (is_numeric($n_cases)){
                        $new_cases = $n_cases;
                    }

                    $t_death = str_replace($stringReplace,'', $total_deaths);
                    if (is_numeric($t_death)){
                        $total_deaths = $t_death;
                    }

                    $n_death = str_replace($stringReplace, '', $new_deaths);
                    if (is_numeric($n_death)){
                        $new_deaths = $n_death;
                    }

                    $t_recovered = str_replace($stringReplace, '', $total_recovered);
                    if (is_numeric($t_recovered)){
                        $total_recovered = $t_recovered;
                    }

                    $n_recovered = str_replace($stringReplace, '', $new_recovered);
                    if (is_numeric($n_recovered)){
                        $new_recovered = $n_recovered;
                    }

                    $a_cases = str_replace($stringReplace, '', $active_cases);
                    if (is_numeric($a_cases)){
                        $active_cases = $a_cases;
                    }

                    $ser = str_replace($stringReplace, '', $serious);
                    if (is_numeric($ser)){
                        $serious = $ser;
                    }

                    $tot = str_replace($stringReplace, '', $tot_cases);
                    if (is_numeric($tot)){
                        $tot_cases = $tot;
                    }

                    $d1m = str_replace($stringReplace, '', $death1m);
                    if (is_numeric($d1m)){
                        $death1m = $d1m;
                    }

                    $t_tests = str_replace($stringReplace, '', $total_tests);
                    if (is_numeric($t_tests)){
                        $total_tests = $t_tests;
                    }

                    $t1m = str_replace($stringReplace, '', $test1m);
                    if (is_numeric($t1m)){
                        $test1m = $t1m;
                    }

                    $pop= str_replace($stringReplace, '', $population);
                    if (is_numeric($pop)){
                        $population = $pop;
                    }



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
            }
        }

        echo "created";
    }



    public function data(){
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
    }

    public function index(){
        $bangladesh = Live::where('country', 'Bangladesh')->get();
        $yesterday = Yesterday::where('country', 'Bangladesh')->get();
        $total = Live::where('country', 'World')->get();
        $data = Live::where('country', '!=', 'World')->get();
        return view('frontend.index', compact('total', 'data', 'bangladesh', 'yesterday'));
    }

    public function country($data){
        $total = Live::where('country', $data)->get();
        $yesterday = Yesterday::where('country', $data)->get();
        $country = Data::where('country', $data)->get();
        return view('frontend.country', compact('total','country', 'yesterday'));
    }
}
