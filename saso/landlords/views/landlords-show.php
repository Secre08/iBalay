<?php
// Database configuration
include('../../database/config.php');

// Fetch all landlord data
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
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($landlords)): ?>
                        <?php $count = 1; ?>
                        <?php foreach ($landlords as $landlord): ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo htmlspecialchars($landlord['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($landlord['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($landlord['email']); ?></td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actionModal" data-action-details="<?php echo htmlspecialchars(json_encode($landlord)); ?>">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No landlords available!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!-- End card -->
</main><!-- End #main -->

<?php include('views/tasks/modal-landlords.php'); ?>

<script src="views/tasks/fetch-landlords.js"></script>
