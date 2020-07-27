<?php
include "includes/functions.php";

$recoveredPercentage = number_format($recoveredPercentage);
$deathPercentage = number_format($deathPercentage);

$array = array();

$array['global'] = array(
    'lastUpdated' => "$last_update",
    'totalConfirmed' => "$total_confirmed",
    'totalDeaths' => "$total_deaths",
    'totalRecovered' => "$total_recovered",
    'currentlyInfectedPatient' => "$currently_infected_patient",
    'closedCases' => "$closed_cases",
    'todaysConfirmedCases' => "$new_confirmed_cases",
    'todaysRecoveredCases' => "$new_recovered_cases",
    'todaysDeathCases' => "$new_death_cases",
    'lastSevenDaysConfirmedCases' => "$last_seven_days_case_report",
    'recoveredPercentage' => "$recoveredPercentage",
    'deathPercentage' => "$deathPercentage",
    'activeCases' => "$activeCases_report"
);

foreach ($data as $key => $value) {
    $confirmed = $value[$days_count]['confirmed'];
    $death = $value[$days_count]['deaths'];
    $recovered = $value[$days_count]['recovered'];
    $newConfirm = $value[$days_count]['confirmed'] - $value[$days_count_prev]['confirmed'];
    $newDeath = $value[$days_count]['deaths'] - $value[$days_count_prev]['deaths'];
    $newRecovered = $value[$days_count]['recovered'] - $value[$days_count_prev]['recovered'];
    $activeCase = $value[$days_count]['confirmed'] - $value[$days_count]['deaths'] - $value[$days_count]['recovered'];

    $array['country'][$key] = array(
        'total_Confirmed' => "$confirmed",
        'total_Death' => "$death",
        'total_recovered' => "$recovered",
        'todaysConfirmed' => "$newConfirm",
        'todaysDeath' => "$newDeath",
        'todaysRecovered' => "$newRecovered",
        'activeCases' => "$activeCase",
        'updated' => "$last_update"
    );

    foreach ($data[$key] as $count){
        $countryDate = $count['date'];
        $countryConfirm = $count['confirmed'];
        $countryDeaths = $count['deaths'];
        $countryRecovered = $count['recovered'];

        $array['allData'][$key][] = array(
            'date' => "$countryDate",
            'confirmed' => "$countryConfirm",
            'deaths' => "$countryDeaths",
            'recovered' => "$countryRecovered"
        );
    }
}


$json = json_encode($array, JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;


?>