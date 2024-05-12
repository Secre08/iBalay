<?php
// Include your database connection file
include('../../../../database/config.php');


// Get the landlord ID from the POST request
$landlordId = $_POST['landlord_id'];

// Perform the database update query to set close_account to 1
$sql = "UPDATE landlord_acc SET close_account = 1 WHERE landlord_id = '$landlordId'";

if (mysqli_query($conn, $sql)) {
    // Close the database connection
    mysqli_close($conn);
    
    // Redirect to owner-list-warning.php
    header("Location: /iBalay.com/iBalay-saso/owner-list-warning.php");
    exit();
} else {
    // If there is an error in the query, send an error response
    echo json_encode(array('success' => false, 'message' => 'Error disabling landlord: ' . mysqli_error($conn)));
}

// Close the database connection
mysqli_close($conn);

?>
