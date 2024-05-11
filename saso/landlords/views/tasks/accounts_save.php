<?php
include('../../../../database/config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $email = $_POST['email'];

    // Update approval status for the landlord account
    $update_sql = "UPDATE `landlord_acc` SET `approval_status` = 1 WHERE `email` = '$email' AND `approval_status` = 0";
    
    if (mysqli_query($conn, $update_sql)) {
        // Success message
        echo "Landlord account confirmed successfully!";
    } else {
        // Error message
        echo "Error confirming landlord account: " . mysqli_error($conn);
    }
} else {
    // Redirect if 'confirm' button is not clicked
    header("Location: account_confirmation.php");
    exit();
}

mysqli_close($conn);
?>
