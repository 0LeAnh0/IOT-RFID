<?php
session_start();
error_reporting(0);
include('../includes/db.php');
error_reporting(0);
if (strlen($_SESSION['account'] == 0)) {
    header('location:logout.php');
} else { ?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>VPS</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/datepicker3.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">

        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">
        <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->
    </head>

    <body>
        <?php include '../includes/navigation.php' ?>

        <?php
        $page = "dashboard";
        include '../includes/sidebar.php'
            ?>

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                            <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php include '../includes/greetings.php' ?>
                    </h1>
                </div>
            </div><!--/.row-->

            <?php include '../includes/footer.php' ?>
        </div> <!--/.main-->

        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/chart.min.js"></script>
        <script src="../js/chart-data.js"></script>
        <script src="../js/easypiechart.js"></script>
        <script src="../js/easypiechart-data.js"></script>
        <script src="../js/bootstrap-datepicker.js"></script>
        <script src="../js/custom.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>
        <script>
            window.onload = function () {
                // var chart1 = document.getElementById("line-chart").getContext("2d");
                // window.myLine = new Chart(chart1).Line(lineChartData, {
                // responsive: true,
                // scaleLineColor: "rgba(0,0,0,.2)",
                // scaleGridLineColor: "rgba(0,0,0,.05)",
                // scaleFontColor: "#c5c7cc"
                // });

                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Vehicle In-Time", "Vehicle Out-Time"],
                        datasets: [{
                            backgroundColor: ["#30a5ff", "#33cccc"],
                            data: [<?php echo $row5['id1']; ?>, <?php echo $row6['id2']; ?>]
                        }]
                    }
                });


            };

        </script>


    </body>

    </html>

<?php } ?>