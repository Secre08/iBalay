<script>
    // Function to display a confirmation dialog and perform action accordingly
    function confirmAction(message, action) {
        if (confirm(message)) {
            // If user confirms, perform the action
            action();
        } else {
            // If user cancels, do nothing
            return false;
        }
    }

    // Function to display an alert and reload the page
    function showAlertAndRefresh(message) {
        alert(message);
        location.reload(); // Reload the page
    }
</script>

<!-- Modify your PHP code to include the confirmation dialog -->
<?php
// Include your database connection file
include('../../database/config.php');
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Fetch data from the landlord_acc and bh_information tables
$sqlOwners = "
    SELECT 
        landlord_acc.landlord_id, 
        landlord_acc.first_name, 
        landlord_acc.last_name, 
        landlord_acc.email, 
        landlord_acc.phone_number, 
        landlord_acc.address, 
        bh_information.bh_id, 
        bh_information.Status, 
        bh_information.warning_count
    FROM 
        landlord_acc 
    JOIN 
        bh_information 
    ON 
        landlord_acc.landlord_id = bh_information.landlord_id
    WHERE
         bh_information.Status = '1' ";


$resultOwners = mysqli_query($conn, $sqlOwners);

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Warning Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/iBalay.com/iBalay-saso/index.php">Home</a></li>
                <li class="breadcrumb-item active">Warning Page</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <?php if ($resultOwners && mysqli_num_rows($resultOwners) > 0): ?>
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Landlords Information</h5>
                        <table class="table table-borderless datatable" id="roomTable">
                            <thead>
                                <tr>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Warning Level</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowOwner = mysqli_fetch_assoc($resultOwners)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($rowOwner['first_name']); ?></td>
                                        <td><?php echo htmlspecialchars($rowOwner['last_name']); ?></td>
                                        <td><?php echo htmlspecialchars($rowOwner['phone_number']); ?></td>
                                        <td><?php echo htmlspecialchars($rowOwner['email']); ?></td>
                                        <td><?php echo htmlspecialchars($rowOwner['address']); ?></td>
                                        <td><?php echo htmlspecialchars($rowOwner['warning_count']); ?></td>
                                        <td>
                                            <form action="views/tasks/set_warning_level.php" method="post" style="display:inline-block;">
                                                <input type="hidden" name="bh_id" value="<?php echo htmlspecialchars($rowOwner['bh_id']); ?>">
                                                <button class="btn btn-danger btn-sm" name="warning_level" value="1" <?php echo $rowOwner['warning_count'] >= 1 ? 'disabled' : 'onclick="return confirmAction(\'Are you sure you want to set warning level 1?\', function() { showAlertAndRefresh(\'Warning level 1 clicked!\'); })"'; ?>>1</button>
                                                <button class="btn btn-danger btn-sm" name="warning_level" value="2" <?php echo $rowOwner['warning_count'] >= 2 ? 'disabled' : 'onclick="return confirmAction(\'Are you sure you want to set warning level 2?\', function() { showAlertAndRefresh(\'Warning level 2 clicked!\'); })"'; ?>>2</button>
                                                <button class="btn btn-danger btn-sm" name="warning_level" value="3" <?php echo $rowOwner['warning_count'] >= 3 ? 'disabled' : 'onclick="return confirmAction(\'Are you sure you want to set warning level 3?\', function() { showAlertAndRefresh(\'Warning level 3 clicked!\'); })"'; ?>>3</button>
                                            </form>
                                            <form action="views/tasks/terminate.php" method="post" style="display:inline-block;">
                                                <input type="hidden" name="bh_id" value="<?php echo htmlspecialchars($rowOwner['bh_id']); ?>">
                                                <button class="btn btn-danger btn-sm" name="terminate_owner" <?php echo $rowOwner['warning_count'] < 3 ? 'disabled' : 'onclick="return confirmAction(\'Are you sure you want to terminate this owner?\', function() { showAlertAndRefresh(\'Terminate button clicked!\'); })"'; ?>>Terminate</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>No landlords found.</p>
        <?php endif; ?>
    </section>
</main>

<?php
// Close the database connection if needed
mysqli_close($conn);
?>

<script>
    // Your AJAX request function
    function sendAjaxRequest(warningLevel, bhId) {
        // Your AJAX request code here
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/iBalay/saso/landlords/views/tasks/set_warning_level.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // If the update was successful, redirect to the warning list page
                        window.location.href = response.redirect;
                    } else {
                        // If there was an error, display an error message
                        alert("Error: " + response.message);
                    }
                } else {
                    // If there was a server error, display an error message
                    alert("Error: Server responded with status " + xhr.status);
                }
            }
        };
        xhr.send("warning_level=" + warningLevel + "&bh_id=" + bhId);
    }
</script>
