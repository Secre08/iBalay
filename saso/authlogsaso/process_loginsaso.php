<?php
session_start();

include ('../../database/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Retrieve hashed password and SASO ID from the database based on the provided username
    $sql = "SELECT saso_id, password FROM saso WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $SASOID = $row['saso_id'];
        $storedPassword = $row['password'];

        // Check if the stored password is hashed
        if (password_verify($password, $storedPassword)) {
            // Passwords match, login successful

            // Set session variables
            $_SESSION['saso_id'] = $SASOID;

            // Redirect to the dashboard page
            header("Location: /iBalay/saso/dashboard/sasohome.php");
            exit();
        } else {
            // Passwords do not match, login failed
            header("Location: /iBalay/saso/dashboard/sasohome.php");
            exit();
        }
    } else {
        // User not found in the database
        header("Location: /iBalay/saso/index.php");
        exit();
    }

    // Close the database connection if needed
    mysqli_close($conn);
}
?>
