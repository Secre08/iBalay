<?php
// Database configuration
include('../../database/config.php');

// Fetch data from the tenant table
$query = "SELECT `TenantID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `address` FROM `tenant`";
$stmt = $conn->prepare($query);

$boarders = [];

if ($stmt->execute()) {
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $boarders[] = $row;
    }
} else {
    echo "Error retrieving boarders: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
