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
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">
    </head>

    <body>
        <?php include '../includes/navigation.php' ?>

        <?php
        $page = "monthly";
        include '../includes/sidebar.php'
            ?>

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">
                            <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Monthly Subscribe</li>
                </ol>
            </div>
            <div class="panel-heading">Monthly Subscribe</div>
            <form method="GET" class="mb-4">
                <div class="form-group">
                    <label for="search">Search Registration Number:</label>
                    <input type="text" class="form-control" id="search" name="search"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Search">
            </form>
            <h3>Guest Registration Number list</h3>
            <?php
            // Database connection settings
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "parking";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Process the form submission
            if (isset($_POST['changeType'])) {
                $registrationNumber = $_POST['registrationNumber'];

                // Update customer_type to 'monthly' for the specified RegistrationNumber
                $updateSql = "UPDATE vehicle_info SET CustomerType = 'monthly' WHERE RegistrationNumber = '$registrationNumber'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "<p class='mt-4 text-success'>Successfully updated RegistrationNumber: <b>$registrationNumber</b> subscription to monthly</p>";
                } else {
                    echo "<p class='mt-4 text-danger'>Error updating customer_type: " . $conn->error . "</p>";
                }
            }

            // Fetch RegistrationNumbers where customer_type is 'guest'
            $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT RegistrationNumber FROM vehicle_info WHERE CustomerType = 'guest'";
            if (!empty($searchKeyword)) {
                $sql .= " AND RegistrationNumber LIKE '%$searchKeyword%'";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul class='list-group'>";
                while ($row = $result->fetch_assoc()) {
                    $registrationNumber = $row["RegistrationNumber"];
                    echo "<li class='list-group-item'>$registrationNumber
                    <form method='POST'>
                    <input type='hidden' name='registrationNumber' value='$registrationNumber'>
                    <button type='submit' name='changeType' class='btn btn-primary'>Subcribe</button>
                    </form>
                        </li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No guest registration numbers found.</p>";
            }

            // Close the database connection
            $conn->close();
            
            ?>
            <?php include '../includes/footer.php' ?>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
<?php } ?>