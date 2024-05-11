<?php
session_start();

include ('../../database/config.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Check if the account exists
$query = "SELECT * FROM landlord_acc WHERE email = ?"; 
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if ($user['approval_status'] == 1) {
        // Account is confirmed, proceed with password verification
        if (password_verify($password, $user['password'])) {
            $_SESSION['landlord_id'] = $user['landlord_id']; 
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password.']);
        }
    } else {
        // Account is not confirmed
        echo json_encode(['success' => false, 'message' => 'Your account is not confirmed.']);
    }
} else {
    // Account does not exist
    echo json_encode(['success' => false, 'message' => 'Your account does not exist.']);
}

$stmt->close();
$conn->close();
?>
