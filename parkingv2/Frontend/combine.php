<!DOCTYPE html>
<html>

<head>
    <title>Monthly Registration Numbers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        session_start();
        error_reporting(0);
        include('../includes/db.php');
        if (strlen($_SESSION['account'] == 0)) {
            header('location:logout.php');
        } else {
        ?>

            <h2 class="mt-4">Monthly Registration Numbers:</h2>
            <form method="GET" class="mb-4">
                <div class="form-group">
                    <label for="search">Search Registration Number:</label>
                    <input type="text" class="form-control" id="search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Search">
            </form>

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

                // Update customer_type to 'guest' for the specified RegistrationNumber
                $updateSql = "UPDATE vehicle_info SET CustomerType = 'guest' WHERE RegistrationNumber = '$registrationNumber'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "<p class='mt-4 text-success'>Successfully updated customer_type to 'guest' for RegistrationNumber: $registrationNumber</p>";
                } else {
                    echo "<p class='mt-4 text-danger'>Error updating customer_type: " . $conn->error . "</p>";
                }
            }

            // Fetch RegistrationNumbers where customer_type is 'monthly'
            $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT RegistrationNumber FROM vehicle_info WHERE CustomerType = 'monthly'";
            if (!empty($searchKeyword)) {
                $sql .= " AND RegistrationNumber LIKE '%$searchKeyword%'";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul class='list-group'>";
                while ($row = $result->fetch_assoc()) {
                    $registrationNumber = $row["RegistrationNumber"];
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>$registrationNumber
                            <form method='POST'>
                                <input type='hidden' name='registrationNumber' value='$registrationNumber'>
                                <button type='submit' name='changeType' class='btn btn-primary'>Change Customer Type</button>
                            </form>
                        </li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No monthly registration numbers found.</p>";
            }

            // Close the database connection
            $conn->close();
            ?>

        <?php
        }
        ?>

    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
