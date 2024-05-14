<?php
include('../../database/config.php');



$bh_id = $_POST['bh_id'];
$status = $_POST['status'];

$sql = "UPDATE bh_information SET Status = ? WHERE bh_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $bh_id);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Status updated successfully']);
} else {
    echo json_encode(['message' => 'Status update failed']);
}

$stmt->close();
$conn->close();
?>
