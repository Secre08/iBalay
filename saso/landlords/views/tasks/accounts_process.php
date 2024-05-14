<?php
include('../../../../database/config.php');
    

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $email = $_POST['email'];

    // Retrieve landlord details based on email
    $sql = "SELECT * FROM `landlord_acc` WHERE `email` = '$email'"; // Removed the approval_status condition
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $password = $row['password']; // You may consider sending a temporary password
        // You may also retrieve other details like phone number and address if needed

        // Insert landlord details into another table for registration
        // Example: Assuming you have a table named 'registered_landlords'
        $insert_sql = "INSERT INTO `registered_landlords` (`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name', '$last_name', '$email', '$password')";
        if (mysqli_query($conn, $insert_sql)) {
            // You can display a success message or redirect to another page
            echo "Landlord registered successfully!";
        } else {
            // Handle registration error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle error if landlord not found
        echo "Error: Landlord not found!";
    }
} else {
    // Redirect if 'confirm' button is not clicked
    header("Location: account_confirmation.php");
    exit();
}

mysqli_close($conn);

?>
