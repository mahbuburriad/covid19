<?php
// Retrieving Json Data
$jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
$data = json_decode($jsonData, true);

$con = mysqli_connect('localhost', 'root', '', 'covid');

mysqli_query($con, "delete from data");

foreach ($data as $key => $allData) {
    foreach ($data[$key] as $keyData) {
        //echo $key." ".$keyData['date'];
        $data_country = $key;
        $data_date = $keyData['date'];
        $data_confirm = $keyData['confirmed'];
        $data_recovered = $keyData['recovered'];
        $data_death = $keyData['deaths'];

/*        $get_data = mysqli_query($con, "Select * From data where data_date = '$data_date' and data_country = $data_country");
        //$get_data = mysqli_query($con, "Select * From data");
        while ($row_data = mysqli_fetch_array($get_data)) {
            $collected_date = $row_data['data_date'];
            $collected_country = $row_data['data_country'];

            if ($collected_date != $data_date && $collected_country != $data_country) {
                //echo $data_date;
                mysqli_query($con, "INSERT INTO data(data_country, data_date, data_confirm, data_recovered, data_death) VALUES ('$data_country', '$data_date', '$data_confirm', '$data_recovered', '$data_death')");
            }
        }*/
        mysqli_query($con, "INSERT INTO data(data_country, data_date, data_confirm, data_recovered, data_death) VALUES ('$data_country', '$data_date', '$data_confirm', '$data_recovered', '$data_death')");


    }
}
?>