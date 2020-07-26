<?php
include "includes/functions.php";
if (isset($_GET['country'])) {
    $getcountry = $_GET['country'];
    ?>

    <!DOCTYPE html>

    <html>

    <head>
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <title><?php echo $getcountry?> Data | COVID-19 Coronavirus Pandemic | Saltanat Global Limited</title>
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
        <div class="label-counter" id="page-top">COVID-19 Coronavirus Pandemic <br> <span><b>Country Name: <?php echo $getcountry; ?></b></span></div>

        <div>
            <?php
            foreach ($data[$getcountry] as $value){
                $countryDate = $value['date'];
                $countryConfirm = $value['confirmed'];
                $countryDeaths = $value['deaths'];
                $countryRecovered = $value['recovered'];
            }
            ?>

            <center>
                <div style="font-size:13px; color:#999; margin-top:5px; text-align:center">Last Updated : <?php
                    $date = date_create($countryDate);
                    echo date_format($date, "F d, Y");
                    ?></div>

            </center>

            <center class="content-inner">
                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Coronavirus Cases:</h1>
                    <div class="maincounter-number">
                        <span style="color:#aaa"><?php echo number_format($countryConfirm); ?></span>
                    </div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px">
                    <h1>Deaths:</h1>
                    <div class="maincounter-number">
                        <?php echo number_format($countryDeaths); ?>
                    </div>
                </div>
                <div class="maincounter-wrap" style="margin-top:15px;">
                    <h1>Recovered:</h1>
                    <div class="maincounter-number" style="color:#8ACA2B ">
                        <?php echo number_format($countryRecovered); ?>
                    </div>
                </div>
            </center>


<!--            <div>-->
<!--                <div class="col-sm-6">-->
<!--                    <div class="card-box">-->
<!--                        <h4 class="header-title m-t-0 m-b-30">Line Chart</h4>-->
<!--                        <canvas id="myChart" width="400" height="400"></canvas>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->


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
                foreach ($data[$getcountry] as $bd) {
                    ?>
                    <tr>
                        <td><?php echo $bd['date'] ?></td>
                        <td><?php echo number_format($bd['confirmed']) ?></td>
                        <td><?php echo number_format($bd['deaths']) ?></td>
                        <td><?php echo number_format($bd['recovered']) ?></td>
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