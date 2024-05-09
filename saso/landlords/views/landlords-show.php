<?php
// Database configuration
include('../../database/config.php');

// Fetch landlord data
$query = "SELECT `landlord_id`, `first_name`, `last_name`, `email`, `phone_number`, `address` FROM `landlord_acc`";
$result = $conn->query($query);

$landlords = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $landlords[] = $row;
    }
}

$conn->close();
?>

<?php include('views/tasks/fetch-landlords.php'); ?>

<main id="main" class="main">
    <div class="pagetitle"> 
        <h1>List of Landlords</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Landlords List</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Landlords List</h5>

            <table class="table datatable">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($landlords)): ?>
                        <?php foreach ($landlords as $landlord): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($landlord['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($landlord['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($landlord['email']); ?></td>
                                <td><?php echo htmlspecialchars($landlord['phone_number']); ?></td>
                                <td><?php echo htmlspecialchars($landlord['address']); ?></td>
                                <td>
                                    <!-- Add actions here if needed -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No landlords available!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!-- End card -->
</main><!-- End #main -->
