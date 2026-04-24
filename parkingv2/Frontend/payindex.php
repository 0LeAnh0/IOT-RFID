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
        <title>Payment Status</title>
        <!-- Include Bootstrap CSS -->

        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/datatable.css" rel="stylesheet">
        <link href="../css/datepicker3.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">
        <style>
            .bg-warning {
                background-color: #ffc107;
            }
        </style>
    </head>

    <body>
        <?php include '../includes/navigation.php' ?>

        <?php
        $page = "paymentstatus";
        include '../includes/sidebar.php'
            ?>

        <div class="container col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">
                            <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Vehicle Category Management</li>
                </ol>
            </div><!--/.row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Payment Status</div>
                        <!-- Add search box -->
                        <div class="form-group">
                            <label for="search">Search Number Plate:</label>
                            <input type="text" id="search" class="form-control" placeholder="Enter number plate">
                            <button class="btn btn-primary mt-2" onclick="searchNumberPlate()">Search</button>
                        </div>
                        <div class="panel-body">
                            <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Number Plate</th>
                                        <th>Payment Status</th>
                                        <th>Pay Total</th>
                                        <th>Order Number</th>
                                        <th>Pay Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // include 'updateplate.php';
                                    // include 'checkdate.php';
                                    ?>
                                    <?php
                                    // Replace 'YourTableName' with the actual table name in your database
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "parking";

                                    // Create a connection
                                    $conn = new mysqli($servername, $username, $password, $database);

                                    // Check the connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }
                                    // Function to generate a random 4-digit order number
                                    function generateOrderNumber()
                                    {
                                        return rand(1000, 9999);
                                    }
                                    
                                    if (isset($_POST['submit'])) {
                                        // Get the number plate and generate an order number
                                        $RegistrationNumber = $_POST['RegistrationNumber'];
                                        $order_number = generateOrderNumber();
                                        // Update the database with the new order number
                                        $sql = "UPDATE vehicle_info SET order_number = $order_number WHERE RegistrationNumber = '$RegistrationNumber'";
                                        $result = $conn->query($sql);

                                        // Redirect to another page
                                        if ($result) {
                                            $sql = "SELECT ParkingCharge FROM vehicle_info WHERE RegistrationNumber = '$RegistrationNumber'";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $pay_total = $row['ParkingCharge'];
                                            echo '<script>window.location.href = "../Frontend/vnpay/vnpay_create_payment.php?order_number=' . $order_number . '&chargetotal=' . $pay_total . '";</script>';
                                        }
                                    }

                                    // Fetch data from the table
                                    $sql = "SELECT * FROM vehicle_info ORDER BY STT DESC";
                                    $result = $conn->query($sql);

                                    // $search = isset($_GET['search']) ? $_GET['search'] : '';
                                    // $sql = "SELECT * FROM paymentstatus WHERE RegistrationNumber LIKE '%$search%'";
                                    // $result = $conn->query($sql);
                                
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['STT'] . "</td>";
                                            echo "<td>" . $row['RegistrationNumber'] . "</td>";
                                            
                                            echo "<td>" . ($row['payment_status'] ? 'Yes' : 'No') . "</td>";
                                            echo "<td>" . ($row['ParkingCharge'] === NULL || $row['ParkingCharge'] === '0' ? 'Current Parking' : $row['ParkingCharge']) . "</td>";
                                            echo "<td>" . $row['order_number'] . "</td>";
                                            echo "<td>" . $row['latest_action_time'] . "</td>";
                                            

                                            // Show "Thanh toán" button only for rows where payment status is "no"
                                            if (!$row['payment_status'] && ($row['ParkingCharge'] !== NULL && $row['ParkingCharge'] !== '0')) {
                                                echo "<td>";
                                                echo "<form method='post'>";
                                                echo "<input type='hidden' name='RegistrationNumber' value='" . $row['RegistrationNumber'] . "'>";
                                                echo "<button type='submit' name='submit' class='btn btn-primary' >Go to payment</button>";
                                                echo "</form>";
                                                echo "</td>";
                                            } else {
                                                echo "<td></td>"; // Empty cell for rows with payment status "yes"
                                            }

                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No records found</td></tr>";
                                    }



                                    // Close the connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php include '../includes/footer.php' ?>
                    </div>
                </div>
            </div>



        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            function searchNumberPlate() {
                var input = document.getElementById('search').value.toUpperCase();
                var table = document.getElementsByTagName('table')[0];
                var rows = table.getElementsByTagName('tr');

                // Loop through all the rows and check if the number plate matches the search input
                for (var i = 0; i < rows.length; i++) {
                    var numberPlateCell = rows[i].getElementsByTagName('td')[0];
                    if (numberPlateCell) {
                        var numberPlate = numberPlateCell.textContent || numberPlateCell.innerText;
                        if (numberPlate.toUpperCase().indexOf(input) > -1) {
                            rows[i].classList.add('bg-warning'); // Highlight the matching row
                            rows[i].scrollIntoView(); // Scroll to the matching row
                        } else {
                            rows[i].classList.remove('bg-warning'); // Remove highlighting from non-matching rows
                        }
                    }
                }
            }
        </script>
        <!-- Include Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </div> <!--/.main-->
    </body>

    </html>
<?php } ?>