<?php
$url = "https://www.worldometers.info/coronavirus/";
$html = file_get_contents($url);
$dom = new domDocument;
@$dom->loadHTML($html);
$tables = $dom->getElementsByTagName('table');
$rows = $tables->item($day)->getElementsByTagName('tr');

$finder = new DomXPath($dom);
$classname = 'font-size:13px; color:#999; margin-top:5px; text-align:center';
$last_update = null;
$nodes = $finder->query("//*[contains(@style, '$classname')]");
foreach ($nodes as $node) {
    $last_update =  $node->nodeValue;
}


    $total_confirmed = 0;
    $total_deaths = 0;
    $total_recovered = 0;
    $currently_infected_patient = 0;
    $serious = 0;
    $new_recovered_cases = 0;
    $new_death_cases = 0;
    $new_confirmed_cases = 0;
    $tot_cases = 0;
    $death1m = 0;

    foreach ($rows as $row) {
        $cols = $row->getElementsByTagName('td');
        if (!empty(@$cols->item(1)->nodeValue == 'World')) {
            $total_confirmed = $cols->item(2)->nodeValue;
            $new_confirmed_cases = $cols->item(3)->nodeValue;
            $total_deaths = $cols->item(4)->nodeValue;
            $total_recovered = $cols->item(6)->nodeValue;
            $currently_infected_patient = $cols->item(8)->nodeValue;
            $serious = $cols->item(9)->nodeValue;
            $new_recovered_cases = $cols->item(7)->nodeValue;
            $new_death_cases = $cols->item(5)->nodeValue;
            $tot_cases = $cols->item(10)->nodeValue;
            $death1m = $cols->item(11)->nodeValue;
        }
    }

    $b = str_replace( ',', '', $currently_infected_patient );
    if( is_numeric( $b ) ) {
        $currently_infected_patient = $b;
    }

    $ser = str_replace( ',', '', $serious );
    if( is_numeric( $ser  ) ) {
        $serious = $ser;
    }

    $rec= str_replace( ',', '', $total_recovered );
    if( is_numeric( $rec  ) ) {
        $total_recovered = $rec;
    }

    $det= str_replace( ',', '', $total_deaths );
    if( is_numeric( $det  ) ) {
        $total_deaths = $det;
    }

    $conf= str_replace( ',', '', $total_confirmed );
    if( is_numeric( $conf  ) ) {
        $total_confirmed = $conf;
    }

    $mild_condition = $currently_infected_patient - $serious;
    $closed_cases = $total_recovered+$total_deaths;
    $recoveredPercentage = 100 - (($total_deaths * 100)/$closed_cases);
    $deathPercentage = 100 - (($total_recovered * 100)/$closed_cases);



?>