<?php
// Include database configuration
include('../../../../database/config.php');

// Check if form is submitted for terminating a landlord's account
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['terminate'])) {
    $email = $_POST['email'];

    // Update the warning count for the landlord
    $update_sql = "UPDATE landlord_acc SET warning_count = warning_count + 1 WHERE email = '$email'";
    if (mysqli_query($conn, $update_sql)) {
        // Check if the warning count exceeds the threshold
        $threshold = 3; // Define the threshold here
        $check_sql = "SELECT warning_count FROM landlord_acc WHERE email = '$email'";
        $result = mysqli_query($conn, $check_sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $warning_count = $row['warning_count'];
            if ($warning_count >= $threshold) {
                // Terminate the landlord's account
                $terminate_sql = "DELETE FROM landlord_acc WHERE email = '$email'";
                if (mysqli_query($conn, $terminate_sql)) {
                    echo "Landlord account terminated successfully!";
                } else {
                    echo "Error terminating landlord account: " . mysqli_error($conn);
                }
            } else {
                echo "Landlord account warned. Total warnings: " . $warning_count;
            }
        } else {
            echo "Error retrieving warning count.";
        }
    } else {
        echo "Error updating warning count: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
