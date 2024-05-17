<?php
include('../../database/config.php');

// Fetch data from bh_information table where status is 2 (declined)
$query = "SELECT l.landlord_id, l.first_name, l.last_name, l.email, b.bh_id, b.BH_name, b.BH_address, 
            b.monthly_payment_rate, b.number_of_kitchen, b.number_of_living_room,
            b.number_of_students, b.number_of_cr, b.number_of_beds, b.number_of_rooms, b.bh_max_capacity, b.gender_allowed
          FROM landlord_acc l 
          INNER JOIN bh_information b ON l.landlord_id = b.landlord_id
          WHERE b.Status = '2'"; // Assuming Status = 2 indicates declined status

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<main id="main" class="main">
    <div class="pagetitle"> 
        <h1>List of Declined BH</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Declined List</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Declined List</h5>

            <table class="table datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>BH Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $count++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['BH_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['first_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['last_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                        // Action column with "View Details" icon
                        echo '<td>';
                        echo '<button class="btn btn-link btn-view-details" data-bs-toggle="modal" data-bs-target="#detailsModal" data-details=\'' . json_encode($row) . '\'><i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div><!-- End card -->
</main><!-- End #main -->

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">BH Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailsModalBody">
                <!-- Details will be displayed here -->
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var detailsModals = document.querySelectorAll('.btn-view-details');
        detailsModals.forEach(function (modal) {
            modal.addEventListener('click', function () {
                var landlordDetails = JSON.parse(modal.getAttribute('data-details'));
                var modalBody = document.getElementById('detailsModalBody');
                modalBody.innerHTML = `
                    <p><strong>BH Name:</strong> ${landlordDetails.BH_name}</p>
                    <p><strong>BH Address:</strong> ${landlordDetails.BH_address}</p>
                    <p><strong>Monthly Payment Rate:</strong> ${landlordDetails.monthly_payment_rate}</p>
                    <p><strong>Number of Kitchen:</strong> ${landlordDetails.number_of_kitchen}</p>
                    <p><strong>Number of Living Room:</strong> ${landlordDetails.number_of_living_room}</p>
                    <p><strong>Number of Students:</strong> ${landlordDetails.number_of_students}</p>
                    <p><strong>Number of CR:</strong> ${landlordDetails.number_of_cr}</p>
                    <p><strong>Number of Beds:</strong> ${landlordDetails.number_of_beds}</p>
                    <p><strong>Number of Rooms:</strong> ${landlordDetails.number_of_rooms}</p>
                    <p><strong>BH Max Capacity:</strong> ${landlordDetails.bh_max_capacity}</p>
                    <p><strong>Gender Allowed:</strong> ${landlordDetails.gender_allowed}</p>
                `;
            });
        });
    });
</script>
