<?php
// Include your database connection file
include('../../../../database/config.php');

// Get the boarding house ID from the POST request
$bhId = $_POST['bh_id'];

// Perform the database update query to set close_bh to 1 for the related boarding house
$sqlUpdateBH = "UPDATE bh_information SET Status = '0' WHERE bh_id = '$bhId'";

if (mysqli_query($conn, $sqlUpdateBH)) {
    // Close the database connection
    mysqli_close($conn);
    
    // Redirect to owner-list-warning.php
    header("Location: /iBalay/saso/landlords/warning_list.php");
    exit();
} else {
    // If there is an error in the bh_information update query, send an error response
    echo json_encode(array('success' => false, 'message' => 'Error updating boarding house: ' . mysqli_error($conn)));
}

// Close the database connection
mysqli_close($conn);
?>
