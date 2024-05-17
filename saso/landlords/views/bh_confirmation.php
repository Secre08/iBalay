<?php
include('../../database/config.php');

// Handle form submissions for approve and disapprove
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['landlord_id']) && isset($_POST['status'])) {
        $landlord_id = intval($_POST['landlord_id']);
        $status = intval($_POST['status']);

        // Ensure the status value is within the allowed range (0, 1, or 2)
        if ($status >= 0 && $status <= 2) {
            $query = "UPDATE `bh_information` SET `Status` = ? WHERE `landlord_id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si', $status, $landlord_id);

            if ($stmt->execute()) {
                $message = "Status updated successfully.";
            } else {
                $message = "Failed to update status: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Invalid status value.";
        }
    } else {
        $message = "Invalid request.";
    }
}

// Fetch data from landlord_acc and bh_information tables using a JOIN operation
$query = "SELECT l.`landlord_id`, l.`first_name`, l.`last_name`, l.`email`, b.`bh_id`, b.`BH_name`, b.`Document1`, b.`Document2` 
          FROM `landlord_acc` l 
          INNER JOIN `bh_information` b ON l.`landlord_id` = b.`landlord_id`
          WHERE b.`Status` IS NULL OR b.`Status` = '0'";

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

    <?php if (isset($message)): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

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
                                    echo '<td>' . htmlspecialchars($row['BH_name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['first_name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['last_name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                    echo '<td>';

                                    // View Documents Icon
                                    echo '<button class="btn btn-primary" onclick="viewDocuments(' . $row['landlord_id'] . ')">';
                                    echo '<i class="bi bi-file-text"></i>'; // Bootstrap Icons file-text icon
                                    echo '</button>';

                                    // Add space between icons
                                    echo '<span style="margin-right: 5px;"></span>';

                                    // Approve Form with Confirmation
                                    echo '<form action="" method="post" onsubmit="return confirm(\'Are you sure you want to approve?\');" style="display:inline;">';
                                    echo '<input type="hidden" name="landlord_id" value="' . $row['landlord_id'] . '">';
                                    echo '<input type="hidden" name="status" value="1">';
                                    echo '<button type="submit" class="btn btn-success">';
                                    echo '<i class="bi bi-check-lg"></i>'; // Bootstrap Icons check-lg icon
                                    echo '</button>';
                                    echo '</form>';

                                    // Add space between icons
                                    echo '<span style="margin-right: 5px;"></span>';

                                    // Disapprove Form with Confirmation
                                    echo '<form action="" method="post" onsubmit="return confirm(\'Are you sure you want to decline?\');" style="display:inline;">';
                                    echo '<input type="hidden" name="landlord_id" value="' . $row['landlord_id'] . '">';
                                    echo '<input type="hidden" name="status" value="2">';
                                    echo '<button type="submit" class="btn btn-danger">';
                                    echo '<i class="bi bi-x-lg"></i>'; // Bootstrap Icons x-lg icon for disapprove
                                    echo '</button>';
                                    echo '</form>';

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
    <div class="modal fade" id="documentsModal" tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentsModalLabel">Landlord Uploaded Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="documentsModalBody">
                <!-- Documents will be displayed here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="prevDocument()">Previous</button>
                <button type="button" class="btn btn-secondary" onclick="nextDocument()">Next</button>
            </div>
        </div>
    </div>
</div>

</main><!-- End #main -->

<script>
    var currentDocumentIndex = 0;
    var documentsCount = 0;

    function viewDocuments(landlordId) {
        // Use AJAX to fetch the document list
        $.ajax({
            type: 'POST',
            url: 'fetch_documents.php',
            data: { landlord_id: landlordId },
            success: function(response) {
                // Update the modal body with the fetched documents
                $('#documentsModalBody').html(response);

                // Show the modal
                $('#documentsModal').modal('show');

                // Initialize document navigation
                currentDocumentIndex = 0;
                documentsCount = $('.document').length;
                updateDocumentNavigation();
            },
            error: function(error) {
                console.error('Error fetching documents:', error);
            }
        });
    }

    function nextDocument() {
        currentDocumentIndex++;
        if (currentDocumentIndex >= documentsCount) {
            currentDocumentIndex = 0;
        }
        updateDocumentNavigation();
    }

    function prevDocument() {
        currentDocumentIndex--;
        if (currentDocumentIndex < 0) {
            currentDocumentIndex = documentsCount - 1;
        }
        updateDocumentNavigation();
    }

    function updateDocumentNavigation() {
        $('.document').hide();
        $('.document').eq(currentDocumentIndex).show();
    }
</script>