<?php
include('../../database/config.php');


// Fetch data from landlord_acc and bh_information tables using a JOIN operation
$query = "SELECT l.`landlord_id`, l.`first_name`, l.`last_name`, l.`email`, b.`bh_id`, b.`BH_name`, b.`Document1`, b.`Document2` 
          FROM `landlord_acc` l 
          INNER JOIN `bh_information` b ON l.`landlord_id` = b.`landlord_id`
          WHERE b.`Status` = 1"; // Assuming 'Status' is a column in the 'bh_information' table
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pending BH Request</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="https://ibalay-project.000webhostapp.com/iBalay.com/iBalay-saso/index.php">Home</a></li>
                <li class="breadcrumb-item">List</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">BH Request Pending</h5>
                        <!-- Table with dynamic data from the database -->
                        <table id="ownersTable" class="table datatable">
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
                                    echo '<td>' . $row['BH_name'] . '</td>';
                                    echo '<td>' . $row['first_name'] . '</td>';
                                    echo '<td>' . $row['last_name'] . '</td>';
                                    echo '<td>' . $row['email'] . '</td>';
                                    echo '<td>';

                                    // View Documents Icon
                                    echo '<button class="btn btn-primary" onclick="viewDocuments(' . $row['landlord_id'] . ')">';
                                    echo '<i class="bi bi-file-text"></i>'; // Bootstrap Icons file-text icon
                                    echo '</button>';

                                    // Add space between icons
                                    echo '<span style="margin-right: 5px;"></span>';

                                    // Approve Icon
                                    echo '<button class="btn btn-success" onclick="confirmApprove(' . $row['landlord_id'] . ')">';
                                    echo '<i class="bi bi-check-lg"></i>'; // Bootstrap Icons check-lg icon
                                    echo '</button>';

                                    // Add space between icons
                                    echo '<span style="margin-right: 5px;"></span>';

                                    // Disapprove Icon
                                    echo '<button class="btn btn-danger" onclick="confirmDisapprove(' . $row['landlord_id'] . ')">';
                                    echo '<i class="bi bi-x-lg"></i>'; // Bootstrap Icons x-lg icon for disapprove
                                    echo '</button>';

                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with dynamic data from the database -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal for displaying documents -->
    <div class="modal fade" id="documentsModal" tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentsModalLabel">landlord Uploaded Documents</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="documentsModalBody">
                    <!-- Documents will be displayed here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for confirmation -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelConfirmation()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="confirmationMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cancelConfirmation()">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAction">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
