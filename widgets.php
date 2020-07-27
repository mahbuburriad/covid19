<?php
include "includes/functions.php";
if (isset($_GET['country']) && isset($_GET['data'])) {
    $getcountry = $_GET['country'];
    $datas = $_GET['data'];
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
              integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
              crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body>

    <?php
    if (isset($_GET['data'])) {
        $storeData = $_GET['data'];


        foreach ($data[$getcountry] as $value) {
            $countryDate = $value['date'];
            $countryConfirm = $value['confirmed'];
            $countryDeaths = $value['deaths'];
            $countryRecovered = $value['recovered'];
        }
        if ($storeData == 'confirm') {
            ?>
            <div style="background: aquamarine">
                <div><h1>Confirm Data</h1></div>
                <div><p><?php echo $countryConfirm ?></p></div>
                <p>powered By Saltanat Global Limited</p>
            </div>

        <?php }
    } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    </body>
    </html>


<?php } else {
    echo "sorry";
} ?>

