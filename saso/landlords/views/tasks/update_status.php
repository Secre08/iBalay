<?php
include('../../../../database/config.php');

if (isset($_POST['landlord_id']) && isset($_POST['status'])) {
    $landlord_id = $_POST['landlord_id'];
    $status = $_POST['status'];

    $query = "UPDATE `bh_information` SET `Status` = ? WHERE `landlord_id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $status, $landlord_id);

    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Failed to update status: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
