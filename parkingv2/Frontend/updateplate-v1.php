<!-- <?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insertQuery = "INSERT INTO paymentstatus (RegistrationNumber, customer_type)
                SELECT RegistrationNumber, CustomerType
                FROM vehicle_info";

if (mysqli_query($conn, $insertQuery)) {
    echo "Data inserted successfully from vehicle_info to paymentstatus.";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Update customer_type in paymentstatus based on vehicle_info
$updateQuery = "UPDATE paymentstatus ps
                INNER JOIN vehicle_info vi ON ps.RegistrationNumber = vi.RegistrationNumber
                SET ps.customer_type = vi.CustomerType";

if (mysqli_query($conn, $updateQuery)) {
    echo "Data updated successfully in paymentstatus based on vehicle_info.";
} else {
    echo "Error updating data: " . mysqli_error($conn);
}
    
    
    // SQL code to delete non-existing RegistrationNumbers from paymentstatus table
    $deleteSql = "
    DELETE FROM paymentstatus
    WHERE RegistrationNumber NOT IN (SELECT RegistrationNumber FROM vehicle_info)
    ";
    // Execute the delete SQL code
    $pdo->exec($deleteSql);
    
    // SQL code to update pay_total to 60000 for customer_type 'monthly'
    $updateSql = "
    UPDATE paymentstatus
    SET pay_total = 60000
    WHERE customer_type = 'monthly'
    ";
    // Execute the update SQL code
    $pdo->exec($updateSql);
    
    echo "Updated successfully.";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
?> -->