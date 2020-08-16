<?php
$url = "https://www.nytimes.com/interactive/2020/science/coronavirus-vaccine-tracker.html";
$html = file_get_contents($url);
$dom = new domDocument;
@$dom->loadHTML($html);
$g_ai0_6 = $dom->getElementById('g-ai0-6');
$rows = $g_ai0_6->getElementsByTagName('p');

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

$preclinical = null;
$phase1 = null;
$phase2 = null;
$phase3 = null;
$approval = null;
$time = null;

foreach ($rows as $row){
    $preclinical =  $row->nodeValue;
}

foreach ($p1 as $row){
    $phase1 =  $row->nodeValue;
}

foreach ($p2 as $row){
    $phase2 =  $row->nodeValue;
}

foreach ($p3 as $row){
    $phase3 =  $row->nodeValue;
}

foreach ($approve as $row){
    $approval =  $row->nodeValue;
}

foreach ($times as $row){
    $time =  $row->nodeValue;
}


?>