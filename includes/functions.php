<?php

// Retrieving Json Data
$jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
$data = json_decode($jsonData, true);

// Counting the number of days in the Json File
foreach($data as $key => $value){
    $days_count = count($value)-1;
    $days_count_prev = $days_count - 1;
    $days_count_seven = $days_count - 7;
}



$total_confirmed = 0;
$total_recovered = 0;
$total_deaths = 0;
$new_confirmed_cases = 0;
$new_recovered_cases = 0;
$new_death_cases = 0;
$new_recovered = 0;
$new_death = 0;
$prev_oneday_cases = 0;
$seven_days_case = 0;
$last_seven_days_case_report = 0;
$last_update = 0;
$activeCases_report = 0;

// Total Cases Calculation
foreach($data as $key => $value){
    $total_confirmed = $total_confirmed + $value[$days_count]['confirmed'];
    $prev_oneday_cases = $prev_oneday_cases+$value[$days_count_prev]['confirmed'];
    $new_confirmed_cases = $total_confirmed-$prev_oneday_cases;

    $seven_days_case = $seven_days_case+$value[$days_count_seven]['confirmed'];
    $last_seven_days_case_report = $total_confirmed - $seven_days_case;

    $total_recovered = $total_recovered + $value[$days_count]['recovered'];
    $new_recovered = $new_recovered + $value[$days_count_prev]['recovered'];
    $new_recovered_cases = $total_recovered - $new_recovered;

    $total_deaths = $total_deaths + $value[$days_count]['deaths'];
    $new_death = $new_death + $value[$days_count_prev]['deaths'];
    $new_death_cases = $total_deaths - $new_death;

    $activeCases_report = $total_confirmed-$total_recovered-$total_deaths;
    $last_update = $value[$days_count]['date'];

}

$currently_infected_patient = $total_confirmed - $total_recovered;
$closed_cases = $total_recovered+$total_deaths;
$recoveredPercentage = 100 - (($total_deaths * 100)/$closed_cases);
$deathPercentage = 100 - (($total_recovered * 100)/$closed_cases);
?>
