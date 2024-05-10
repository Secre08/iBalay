<?php
// Database configuration
include('../../database/config.php');

// Fetch data from the tenant table
$query = "SELECT `TenantID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `address`, `student_id`, `gender` FROM `tenant`";
$result = $conn->query($query);

$boarders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $boarders[] = $row;
    }
}

$conn->close();
?>

<main id="main" class="main">
    <div class="pagetitle"> 
        <h1>List of Boarders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Boarders List</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Boarders List</h5>

            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($boarders)): ?>
                        <?php foreach ($boarders as $boarder): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($boarder['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($boarder['FirstName']); ?></td>
                                <td><?php echo htmlspecialchars($boarder['LastName']); ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#viewDetailsModal" data-details="<?php echo htmlspecialchars(json_encode($boarder)); ?>">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No boarders available!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!-- End card -->
</main><!-- End #main -->

<!-- Modal for Viewing Details -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">Boarder Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Student ID:</strong> <span id="studentID"></span></p>
                <p><strong>Name:</strong> <span id="name"></span></p>
                <p><strong>Email:</strong> <span id="email"></span></p>
                <p><strong>Phone Number:</strong> <span id="phoneNumber"></span></p>
                <p><strong>Address:</strong> <span id="address"></span></p>
                <p><strong>Gender:</strong> <span id="gender"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
    const viewDetailsButtons = document.querySelectorAll('.view-details');
    const studentIDElement = document.getElementById('studentID');
    const nameElement = document.getElementById('name');
    const emailElement = document.getElementById('email');
    const phoneNumberElement = document.getElementById('phoneNumber');
    const addressElement = document.getElementById('address');
    const genderElement = document.getElementById('gender');

    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', () => {
            const details = JSON.parse(button.getAttribute('data-details'));
            studentIDElement.textContent = details.student_id;
            nameElement.textContent = details.FirstName + ' ' + details.LastName;
            emailElement.textContent = details.Email;
            phoneNumberElement.textContent = details.PhoneNumber;
            addressElement.textContent = details.address;
            genderElement.textContent = details.gender;
        });
    });
</script>
