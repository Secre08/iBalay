function confirmAccount(email) {
    // Assuming you have an AJAX function to send confirmation to the server
    // You can replace this with your actual AJAX function
    $.ajax({
        type: "POST",
        url: "confirm_landlord_account.php", // Replace with your confirmation script
        data: { email: email },
        success: function(response) {
            // Handle success response
            console.log(response);
            // Reload the page or update the UI as needed
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(error);
        }
    });
}
