<?php
$url = "https://www.worldometers.info/coronavirus/";
$html = file_get_contents($url);
$dom = new domDocument;
@$dom->loadHTML($html);
$tables = $dom->getElementsByTagName('table');
$rows = $tables->item(2)->getElementsByTagName('tr');

$finder = new DomXPath($dom);
$classname = 'font-size:13px; color:#999; margin-top:5px; text-align:center';
$last_update = null;
$nodes = $finder->query("//*[contains(@style, '$classname')]");
foreach ($nodes as $node) {
    $last_update =  $node->nodeValue;
}


$total_confirmed = 0;
foreach ($rows as $row) {
    $cols = $row->getElementsByTagName('td');
    if (!empty(@$cols->item(1)->nodeValue == 'World')) {
        $total_confirmed = $cols->item(2)->nodeValue;

    }
}

echo "<table>";
echo "<tr>
<th>#</th>
<th >Country,<br />Other</th>
<th >Total<br />Cases</th>
<th >New<br />Cases</th>
<th>Total<br />Deaths</th>
<th>New<br />Deaths</th>
<th >Total<br />Recovered</th>
<th>New<br />Recovered</th>
<th>Active<br />Cases</th>
<th >Serious,<br />Critical</th>
<th >Tot&nbsp;Cases/<br />1M pop</th>
<th >Deaths/<br />1M pop</th>
<th >Total<br />Tests</th>
<th >Tests/<br />
<nobr>1M pop</nobr>
</th>
<th >Population</th>
</tr>";

foreach ($rows as $row) {
    $cols = $row->getElementsByTagName('td');
    if (!empty($cols->item(0)->nodeValue) || !empty(@$cols->item(1)->nodeValue == 'World')) {
        echo "<tr><td>" . $cols->item(0)->nodeValue . "</td><td>" . $cols->item(1)->nodeValue . "</td><td>" . $cols->item(2)->nodeValue . "</td><td>" . $cols->item(3)->nodeValue . "</td><td>" . $cols->item(4)->nodeValue . "</td><td>" . $cols->item(5)->nodeValue . "</td><td>" . $cols->item(6)->nodeValue . "</td><td>" . $cols->item(7)->nodeValue . "</td><td>" . $cols->item(8)->nodeValue . "</td><td>" . $cols->item(9)->nodeValue . "</td><td>" . $cols->item(10)->nodeValue . "</td><td>" . $cols->item(11)->nodeValue . "</td><td>" . $cols->item(12)->nodeValue . "</td><td>" . $cols->item(13)->nodeValue . "</td><td>" . $cols->item(14)->nodeValue . "</td></tr>";

    }
}
echo "</table>";
?>