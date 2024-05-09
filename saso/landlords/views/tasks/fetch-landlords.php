<?php
// Include database configuration
include('../../database/config.php');

// Start session and get SASO ID
session_start();

// Initialize landlords array
$landlords = [];

// Check if SASO ID is set in session
if (isset($_SESSION['saso_id'])) {
    // Get SASO ID from session
    $saso_id = $_SESSION['saso_id'];

    // Fetch landlord data for the current SASO ID
    $query = "SELECT landlord_id, firstname, lastname, email, phone_number, address FROM landlord_acc WHERE saso_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $saso_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $landlords[] = $row; // Store each landlord's data in the array
        }
    } else {
        echo "Error retrieving landlords: " . $stmt->error;
        exit; // Terminate script execution in case of error
    }

    $stmt->close();
}

$conn->close();

// Output landlords data as JSON
echo json_encode($landlords);
?>
