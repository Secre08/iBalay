<?php
// Include your database connection file
include('../../../../database/config.php');

// Get the warning level and landlord ID from the AJAX request
$warningLevel = $_POST['warning_level'];
$landlordId = $_POST['landlord_id'];

// Perform the database update query to set warning level
$sql = "UPDATE landlord_acc SET warning_count = ? WHERE landlord_id = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);
if ($stmt) {
    // Bind the parameters and execute the statement
    $stmt->bind_param("ii", $warningLevel, $landlordId);
    if ($stmt->execute()) {
        // If the query is successful, redirect to the specified URL
        header('Location: warning_landlords.php');
        exit(); // Terminate script execution after redirection
    } else {
        // If there is an error in the query, send an error response
        echo json_encode(array('success' => false, 'message' => 'Error updating warning level: ' . $conn->error));
    }
    // Close the statement
    $stmt->close();
} else {
    // If there is an error in preparing the statement, send an error response
    echo json_encode(array('success' => false, 'message' => 'Error preparing statement: ' . $conn->error));
}

// Close the database connection
$conn->close();
?>
