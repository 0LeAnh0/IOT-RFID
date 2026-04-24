<?php
session_start();
error_reporting(0);
include('../includes/db.php');
if (strlen($_SESSION['account'] == 0)) {
	header('location:logout.php');
} else {
	?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>VPS</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/font-awesome.min.css" rel="stylesheet">
		<link href="../css/datatable.css" rel="stylesheet">
		<link href="../css/datepicker3.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">

		<!--Custom Font-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
			rel="stylesheet">

	</head>

	<body>
		<?php include '../includes/navigation.php' ?>

		<?php
		$page = "out-vehicle";
		include '../includes/sidebar.php'
			?>

		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="dashboard.php">
							<em class="fa fa-home"></em>
						</a></li>
					<li class="active">Outgoing Vehicle Management</li>
				</ol>
			</div><!--/.row-->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Outgoing Vehicles</div>
						<div class="panel-body">
							<table id="example" class="table table-striped table-hover table-bordered" style="width:100%">

								<thead>
									<tr>
										<th>#</th>
										<th>Vehicle No.</th>
										<th>Company</th>
										<!-- <th>Category</th> -->
										<!-- <th>Parking Number</th> -->
										<th>Charge</th>
										<th>Vehicle's Owner</th>
										<th></th>

									</tr>
								</thead>
								<tbody>
								
								</tbody>

							</table>
						</div>
					</div>
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
		<script src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.bootstrap4.min.js"></script>
		<script src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/custom.js"></script>

		<script>
			$(document).ready(function () {
				var table = $('#example').DataTable({
					"ajax": {
						"url": "out-vehicle-ajax.php",
						"type": "POST"
					},
					"columns": [
						{ "data": "STT" },
						{ "data": "RegistrationNumber" },
						{ "data": "VehicleCompanyname" },
						{ "data": "ParkingCharge" },
						{ "data": "OwnerName" },
						{
							"data": null,
							"render": function (data, type, row) {
								return "<a href='outgoing-detail.php?updateid=" + row.STT + "' class='btn btn-sm btn-info' data-stt='" + row.STT + "'>View Details</a> <a href='print-receipt.php?vid=" + row.STT + "'><button type='button' class='btn btn-sm btn-warning'> <i class='fa fa-print'></i></button>";
							},
							"className": "text-center"
						},
					]
				});
				setInterval(function () {
					table.ajax.reload();
				}, 5000);
			});
		</script>

	</body>

	</html>

<?php } ?>