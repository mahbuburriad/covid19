<?php
$day = 0;
include "includes/realtimeData.php";

class BanglaConverter {
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

    public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }
}

if (isset($_GET['country'])) {
    $getcountry = $_GET['country'];

    $total_confirmed = 0;
    $death = 0;
    $total_recovery = 0;
    $currently_infected_patient = 0;
    $serious = 0;
    $new_recovery = 0;
    $new_death = 0;
    $new_confirmed_cases = 0;
    $tot_cases = 0;
    $death1m = 0;

    foreach ($rows as $row) {
        $cols = $row->getElementsByTagName('td');
        if (!empty(@$cols->item(1)->nodeValue == $getcountry)) {
            $total_confirmed = $cols->item(2)->nodeValue;
            $new_confirmed_cases = $cols->item(3)->nodeValue;
            $death = $cols->item(4)->nodeValue;
            $total_recovery = $cols->item(6)->nodeValue;
            $currently_infected_patient = $cols->item(8)->nodeValue;
            $serious = $cols->item(9)->nodeValue;
            $new_recovery = $cols->item(7)->nodeValue;
            $new_death = $cols->item(5)->nodeValue;
            $tot_cases = $cols->item(10)->nodeValue;
            $death1m = $cols->item(11)->nodeValue;
        }
    }

    $b = str_replace(',', '', $currently_infected_patient);
    if (is_numeric($b)) {
        $currently_infected_patient = $b;
    }

    $ser = str_replace(',', '', $serious);
    if (is_numeric($ser)) {
        $serious = $ser;
    }

    $rec = str_replace(',', '', $total_recovery);
    if (is_numeric($rec)) {
        $total_recovery = $rec;
    }

    $death = str_replace(',', '', $death);

    $conf = str_replace(',', '', $total_confirmed);
    if (is_numeric($conf)) {
        $total_confirmed = $conf;
    }

    $mild_condition = $currently_infected_patient - $serious;
    @$closed_cases = $total_recovery + $death;
    @$recoveredPercentage = 100 - (($death * 100) / $closed_cases);
    $deathPercentage = 100 - (($total_recovery * 100) / $closed_cases);
    ?>

    <!DOCTYPE html>

    <html>

    <head>
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <title><?php echo $getcountry ?> Data | COVID-19 Coronavirus Pandemic | Saltanat Global Limited</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <!-- Multi Item Selection examples -->
        <link href="assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

        <!--    <link rel="canonical" href="https://amp.dev/documentation/guides-and-tutorials/start/create/basic_markup/">-->
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "NewsArticle",
                "headline": "Open-source framework for publishing content",
                "datePublished": "2015-10-07T12:02:41Z",
                "image": [
                    "logo.jpg"
                ]
            }
        </script>
        <style amp-boilerplate>body {
                -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
                -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
                -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
                animation: -amp-start 8s steps(1, end) 0s 1 normal both
            }

            @-webkit-keyframes -amp-start {
                from {
                    visibility: hidden
                }
                to {
                    visibility: visible
                }
            }

            @-moz-keyframes -amp-start {
                from {
                    visibility: hidden
                }
                to {
                    visibility: visible
                }
            }

            @-ms-keyframes -amp-start {
                from {
                    visibility: hidden
                }
                to {
                    visibility: visible
                }
            }

            @-o-keyframes -amp-start {
                from {
                    visibility: hidden
                }
                to {
                    visibility: visible
                }
            }

            @keyframes -amp-start {
                from {
                    visibility: hidden
                }
                to {
                    visibility: visible
                }
            }</style>
        <noscript>
            <style amp-boilerplate>body {
                    -webkit-animation: none;
                    -moz-animation: none;
                    -ms-animation: none;
                    animation: none
                }</style>
        </noscript>


        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>

        <script src="assets/js/modernizr.min.js"></script>

        <link rel="stylesheet" href="assets/map/leaflet.css"/>
        <script src="assets/map/leaflet.js"></script>
        <script src="http://www.webglearth.com/v2/api.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/custom/custom.css" type="text/css">

        <!--    meta tag for SEO-->
        <meta name="title" content="COVID-19 Coronavirus Pandemic | Saltanat Global Limited">
        <meta name="description"
              content="Live statistics and coronavirus news tracking the number of confirmed cases, recovered patients and death toll due to the COVID-19 coronavirus from Wuhan, China. Coronavirus counter with new cases, deaths, news and updates">
        <meta name="keywords"
              content="covid19, coronavirus, corona virus, show corona virus information, corona virus info, corona virus status, coronavirus info, covid19 tracker, covid19 status, find covid19 data, find corona virus information, get corona virus data, get covid19 data, coronavirus update, coronavirus bangladesh, corona virus US">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">
        <meta name="revisit-after" content="0 days">
        <meta name="author" content="Saltanat Global Limited">

        <!--    meta tag for social media-->

        <meta property="og:title" content="COVID-19 Coronavirus Pandemic | Saltanat Global Limited">
        <meta property="og:description"
              content="Live statistics and coronavirus news tracking the number of confirmed cases, recovered patients and death.Coronavirus counter with new cases, deaths, news and updates">
        <meta property="og:url" content="http://covid19.saltanatglobal.com">
        <meta property="og:type" content="website">
    </head>

    <body>
    <div class="container">
        <div class="label-counter" id="page-top">COVID-19 Coronavirus Pandemic <br>
            <span><b>Country Name: <?php echo $getcountry; ?></b></span></div>

        <div>
            <center>
                <div style="font-size:13px; color:#999; margin-top:5px; text-align:center"><?php echo $last_update; ?></div>

            </center>

            <center class="content-inner">
                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Coronavirus Cases:</h1>
                    <div class="maincounter-number">
                        <span style="color:#aaa"><?php echo number_format($total_confirmed); ?></span>
                    </div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Deaths:</h1>
                    <div class="maincounter-number">
                        <?php echo $death; ?>
                    </div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px;">
                    <h1>Recovered:</h1>
                    <div class="maincounter-number" style="color:#8ACA2B ">
                        <?php echo number_format($total_recovery); ?>
                    </div>
                </div>
            </center>


            <div style="margin-top:50px;"></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header title-case">Active cases</h5>
                        <div class="card-body">
                            <center>
                                <h5 class="card-title number-table-main"><?php echo number_format($currently_infected_patient) ?></h5>
                                <p style="color: #222">Currently Infected Patients</p>

                                <div class="row">
                                    <div class="col-md-6">
                                <span class="number-table"
                                      style="color: #8080FF;"><?php echo number_format($mild_condition) ?></span><br>
                                        <span style="font-size: 13px;">in Mild Condition</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="number-table"><?php echo number_format($serious) ?></span><br>
                                        <span style="font-size: 13px;">Serious or Critical</span>
                                    </div>
                                </div>
                            </center>

                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header title-case">Closed cases</h5>
                        <div class="card-body">
                            <center>
                                <h5 class="card-title number-table-main"><?php echo number_format($closed_cases) ?></h5>
                                <p style="color: #222">Cases which had an outcome:</p>

                                <div class="row">
                                    <div class="col-md-6">
                                <span class="number-table" style="color: #8ACA2B;"
                                ><?php echo number_format($total_recovery) ?></span>
                                        <span>(<b><?php echo number_format($recoveredPercentage) ?></b>%)</span>
                                        <br>
                                        <span style="font-size: 13px;">Recovered / Discharged</span>
                                    </div>
                                    <div class="col-md-6">
                                <span class="number-table"
                                      style="color: red;"><?php echo $death ?></span>
                                        <span>(<b><?php echo number_format($deathPercentage) ?></b>%)</span>
                                        <br>
                                        <span style="font-size: 13px;">Deaths</span>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top:50px;"></div>

            <?php
            if (empty($new_recovery) && empty($new_death)) {
                $day = 1;
                include "includes/realtimeData.php";
                $new_recovery = 0;
                $new_death = 0;
                foreach ($rows as $row) {
                    $cols = $row->getElementsByTagName('td');
                    if (!empty(@$cols->item(1)->nodeValue == $getcountry)) {
                        $new_recovery = $cols->item(7)->nodeValue;
                        $new_death = $cols->item(5)->nodeValue;
                    }
                }
            }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header title-case">Recovered Statistics</h5>
                        <div class="card-body">
                            <center>
                                <h5 class="card-title number-table-main"><?php echo $new_recovery ?></h5>
                                <p style="color: #222">New Recovered Cases since Yesterday</p>
                            </center>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header title-case">Death Statistics</h5>
                        <div class="card-body">
                            <center>
                                <h5 class="card-title number-table-main"><?php echo $new_death ?></h5>
                                <p style="color: #222">New Death Cases since Yesterday</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top:50px;"></div>
            </center>

            <div>
                <div class="col-sm-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Line Chart</h4>
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>


            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead style="color: #666666">
                <tr>
                    <th>Date</th>
                    <th>Confirmed</th>
                    <th>Deaths</th>
                    <th>Recovered</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include "includes/functions.php";
                if ($getcountry == 'USA') {
                    $getcountry = 'US';
                }

                foreach ($data[$getcountry] as $bd) {
                    ?>
                    <tr>
                        <td style="text-align: right"><?php echo $bd['date'] ?></td>
                        <td style="text-align: right"><?php echo number_format($bd['confirmed']) ?></td>
                        <td style="text-align: right"> <?php echo number_format($bd['deaths']) ?></td>
                        <td style="text-align: right"><?php echo number_format($bd['recovered']) ?></td>
                    </tr>
                <?php } ?>


                </tbody>

            </table>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [
                    <?php
                    foreach ($data[$getcountry] as $bd) {
//                    $date =  date_create($bd['date']);
//                    $format = date_format($date, "F d, Y");
//                    echo $format.",";
                        echo $bd['date'] . ",";
                    }

                    ?>
                ],
                datasets: [{
                    label: "Covid19 statistics <?php echo $_GET['country'] ?>",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#10c469",
                    borderColor: "#10c469",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#10c469",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#10c469",
                    pointHoverBorderColor: "#eef0f2",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [
                        <?php
                        foreach ($data[$getcountry] as $bd) {
                            echo $bd['confirmed'] . ",";
                        }


                        ?>
                    ]
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>

    <!-- Required datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>

    <!-- Key Tables -->
    <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Selection table -->
    <script src="assets/plugins/datatables/dataTables.select.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            // Default Datatable
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf'],

            });
            table.order([0, 'desc']).draw();

            // Key Tables

            $('#key-table').DataTable({
                keys: true
            });

            // Responsive Datatable
            $('#responsive-datatable').DataTable();

            // Multi Selection Datatable
            $('#selection-datatable').DataTable({
                select: {
                    style: 'multi'
                }
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

            var table2 = $('#datatable').DataTable();
            var table3 = $('#responsive-datatable').DataTable();

            table2.order([2, 'desc']).draw();
            table3.order([0, 'desc']).draw();
            table.find("Bangladesh");


        });

    </script>

    </body>

    </html>
<?php } else {
    echo "<script>window.open('index','_self')</script>";
} ?>