<?php
// Include your database connection file
include('../../../../database/config.php');

// Get the warning level and BH ID from the AJAX request
$warningLevel = $_POST['warning_level'];
$bhId = $_POST['bh_id'];

// Perform the database update query to set warning level
$sql = "UPDATE bh_information SET warning_count = ? WHERE bh_id = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);
if ($stmt) {
    // Bind the parameters and execute the statement
    $stmt->bind_param("ii", $warningLevel, $bhId);
    if ($stmt->execute()) {
        // If the query is successful, send a success response
        echo json_encode(array('success' => true));
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
<?php
// Include your database connection file
include('../../../../database/config.php');

// Get the warning level and BH ID from the AJAX request
$warningLevel = $_POST['warning_level'];
$bhId = $_POST['bh_id'];

// Debugging: Output received data
echo "Received warning level: " . $warningLevel . ", BH ID: " . $bhId;

// Close the database connection
$conn->close();
?>
