<?php
include "includes/functions.php";
?>

<!DOCTYPE html>

<html>

<head>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>COVID-19 Coronavirus Pandemic | Saltanat Global Limited</title>
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
    <div class="label-counter" id="page-top">COVID-19 Coronavirus Pandemic</div>
    <center>

        <div style="font-size:13px; color:#999; margin-top:5px; text-align:center">Last Updated : <?php
            $date = date_create($last_update);
            echo date_format($date, "F d, Y");
            ?></div>

    </center>

    <center class="content-inner">
        <!--        <div style="margin-top:20px; text-align:center; font-size:14px">-->
        <!--            <a href="/">Global</a> - -->
        <!--            <a href="/bangladesh">Bangladesh</a>-->
        <!--        </div>-->
        <div class="maincounter-wrap" style="margin-top:15px">
            <h1>Coronavirus Cases:</h1>
            <div class="maincounter-number">
                <span style="color:#aaa"><?php echo number_format($total_confirmed); ?></span>
            </div>
        </div>
        <div class="maincounter-wrap" style="margin-top:15px">
            <h1>Deaths:</h1>
            <div class="maincounter-number">
                <?php echo number_format($total_deaths); ?>
            </div>
        </div>
        <div class="maincounter-wrap" style="margin-top:15px;">
            <h1>Recovered:</h1>
            <div class="maincounter-number" style="color:#8ACA2B ">
                <?php echo number_format($total_recovered); ?>
            </div>
        </div>
        <div style="margin-top:50px;"></div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header title-case">Active cases</h5>
                    <div class="card-body">
                        <h5 class="card-title number-table-main"><?php echo number_format($currently_infected_patient) ?></h5>
                        <p style="color: #222">Currently Infected Patients</p>

                        <div class="row">
                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: #8080FF;"><?php echo number_format($new_confirmed_cases) ?></span><br>
                                <span style="font-size: 13px;">New Confirmed Cases</span>
                            </div>
                            <div class="col-md-6">
                                <span class="number-table"><?php echo number_format($last_seven_days_case_report) ?></span><br>
                                <span style="font-size: 13px;">Last 7 Days Cases</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header title-case">Closed cases</h5>
                    <div class="card-body">
                        <h5 class="card-title number-table-main"><?php echo number_format($closed_cases) ?></h5>
                        <p style="color: #222">Cases which had an outcome:</p>

                        <div class="row">
                            <div class="col-md-6">
                                <span class="number-table" style="color: #8ACA2B;"
                                ><?php echo number_format($total_recovered) ?></span>
                                <span>(<b><?php echo number_format($recoveredPercentage) ?></b>%)</span>
                                <br>
                                <span style="font-size: 13px;">Recovered / Discharged</span>
                            </div>
                            <div class="col-md-6">
                                <span class="number-table"
                                      style="color: red;"><?php echo number_format($total_deaths) ?></span>
                                <span>(<b><?php echo number_format($deathPercentage) ?></b>%)</span>
                                <br>
                                <span style="font-size: 13px;">Deaths</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:50px;"></div>


        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header title-case">Recovered Statistics</h5>
                    <div class="card-body">
                        <h5 class="card-title number-table-main"><?php echo number_format($new_recovered_cases) ?></h5>
                        <p style="color: #222">New Recovered Cases since Yesterday</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header title-case">Death Statistics</h5>
                    <div class="card-body">
                        <h5 class="card-title number-table-main"><?php echo number_format($new_death_cases) ?></h5>
                        <p style="color: #222">New Death Cases since Yesterday</p>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:50px;"></div>
    </center>


    <!--    table for confirmed data table-->

    <div>

        <h1>Data Table</h1>

        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead style="color: #666666">
            <tr>
                <th>Country</th>
                <th>Total Cases</th>
                <th>New Cases</th>
                <th>Total Death</th>
                <th>New Death</th>
                <th>Total Recovered</th>
                <th>New Recovered</th>
                <th>Active Cases</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $key => $value) {
                $newConfirm = $value[$days_count]['confirmed'] - $value[$days_count_prev]['confirmed'];
                $newDeath = $value[$days_count]['deaths'] - $value[$days_count_prev]['deaths'];
                $newRecovered = $value[$days_count]['recovered'] - $value[$days_count_prev]['recovered'];
                $activeCase = $value[$days_count]['confirmed'] - $value[$days_count]['deaths'] - $value[$days_count]['recovered'];
                ?>
                <tr>
                    <th scope="row"><?php echo $key ?></th>
                    <td style="text-align: right">
                        <?php echo number_format($value[$days_count]['confirmed']); ?>
                    </td>
                    <td style="text-align: right"><?php
                        if ($newConfirm != 0) {
                            echo number_format($newConfirm);
                        } ?></td>
                    <td style="text-align: right"><?php echo number_format($value[$days_count]['deaths']); ?></td>
                    <td style="background: red; color: white; text-align: right"><?php
                        if ($newDeath != 0) {
                            echo number_format($newDeath);
                        } ?></td>
                    <td style="text-align: right"><?php echo number_format($value[$days_count]['recovered']); ?></td>
                    <td style="text-align: right"><?php
                        if ($newRecovered != 0) {
                            echo number_format($newRecovered);
                        } ?></td>
                    <td style="text-align: right"><?php echo number_format($activeCase); ?></td>

                </tr>
            <?php } ?>

            </tr>
            </tbody>
            <tfoot>
            <th style="text-align: right">Total:</th>
            <th style="text-align: right"><?php echo number_format($total_confirmed) ?></th>
            <th style="text-align: right"><?php echo number_format($new_confirmed_cases) ?></th>
            <th style="text-align: right"><?php echo number_format($total_deaths) ?></th>
            <th style="text-align: right"><?php echo number_format($new_death_cases) ?></th>
            <th style="text-align: right"><?php echo number_format($total_recovered) ?></th>
            <th style="text-align: right"><?php echo number_format($new_recovered_cases) ?></th>
            <th style="text-align: right"><?php echo number_format($activeCases_report) ?></th>
            </tfoot>
        </table>
    </div>


    <div>

        <h1>Bangladeshi Data</h1>

        <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
            foreach ($data['Bangladesh'] as $bd) {
                ?>
                <tr>
                    <td><?php echo $bd['date'] ?></td>
                    <td><?php echo $bd['confirmed'] ?></td>
                    <td><?php echo $bd['deaths'] ?></td>
                    <td><?php echo $bd['recovered'] ?></td>
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
        table.order([1, 'desc']).draw();

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