<?php
include('../../../../database/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['confirm'])){
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
    } elseif(isset($_POST['decline'])){
        $email = $_POST['email'];

        // Delete the landlord account
        $delete_sql = "DELETE FROM `landlord_acc` WHERE `email` = '$email' AND `approval_status` = 0";

        if (mysqli_query($conn, $delete_sql)) {
            // Success message
            echo "Landlord account declined and deleted successfully!";
        } else {
            // Error message
            echo "Error declining landlord account: " . mysqli_error($conn);
        }
    } else {
        // Redirect if neither 'confirm' nor 'decline' button is clicked
        header("Location: account_confirmation.php");
        exit();
    }
} else {
    // Redirect if not a POST request
    header("Location: account_confirmation.php");
    exit();
}

mysqli_close($conn);
?>
<script>
    // Reload the current page after a short delay to allow time for the message to be displayed
    setTimeout(function(){
        window.location.reload();
    }, 1000); // Adjust the delay time as needed (in milliseconds)
</script>
