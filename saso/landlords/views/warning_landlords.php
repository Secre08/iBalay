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
                                                <button class="btn btn-danger btn-sm" name="warning_level" value="1" <?php echo $rowOwner['warning_count'] >= 1 ? 'disabled' : ''; ?>>1</button>
                                                <button class="btn btn-danger btn-sm" name="warning_level" value="2" <?php echo $rowOwner['warning_count'] >= 2 ? 'disabled' : ''; ?>>2</button>
                                                <button class="btn btn-danger btn-sm" name="warning_level" value="3" <?php echo $rowOwner['warning_count'] >= 3 ? 'disabled' : ''; ?>>3</button>
                                            </form>
                                            <form action="views/tasks/terminate.php" method="post" style="display:inline-block;">
                                                <input type="hidden" name="bh_id" value="<?php echo htmlspecialchars($rowOwner['bh_id']); ?>">
                                                <button class="btn btn-danger btn-sm" name="terminate_owner" <?php echo $rowOwner['warning_count'] < 3 ? 'disabled' : ''; ?>>Terminate</button>
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
