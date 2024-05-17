<?php
// Database configuration
include('../../database/config.php');

// Fetch landlords with status = 1
$query = "SELECT l.`landlord_id`, l.`first_name`, l.`last_name`, l.`email`, l.`phone_number`, l.`address` 
          FROM `landlord_acc` l 
          INNER JOIN `bh_information` b ON l.`landlord_id` = b.`landlord_id`
          WHERE b.`Status` = '1'";
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
                                    <!-- Use an icon instead of text for the button -->
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actionModal" data-action-details="<?php echo htmlspecialchars(json_encode($landlord)); ?>">
                                        <!-- Bootstrap Icons info-circle icon -->
                                        <i class="bi bi-info-circle"></i> 
                                        <!-- Add tooltip for "View Details" -->
                                        <span class="visually-hidden">View Details</span>
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
