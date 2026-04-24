<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL code to insert unique values into paymentstatus table and update pay_total based on customer_type
    $sql = "
    INSERT INTO paymentstatus (RegistrationNumber, pay_total, customer_type)
    SELECT DISTINCT vi.RegistrationNumber, 
        CASE WHEN vi.CustomerType = 'monthly' THEN 60000 ELSE vi.ParkingCharge END AS pay_total,
        vi.CustomerType
    FROM vehicle_info vi
    WHERE vi.RegistrationNumber NOT IN (SELECT RegistrationNumber FROM paymentstatus)
    ";

    // Execute the SQL code
    $pdo->exec($sql);
    
    
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
?>
