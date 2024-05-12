<main id="main" class="main">

    <div class="pagetitle">
        <h1>Warning Landlords</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Warning List</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Landlords Information</h5>
                    <table class="table table-borderless datatable" id="roomTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Location</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Warning Count</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../../database/config.php';

                            $sql = "SELECT `landlord_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `approval_status`, `warning_count` FROM `landlord_acc` WHERE 1";

                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['first_name']; ?></td>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['phone_number']; ?></td>
                                        <td><?php echo $row['warning_count']; ?></td>
                                        <td>
                                            <?php if ($row['approval_status'] != 1) { ?>
                                                <form action="views/tasks/set_warning_level.php" method="post">
                                                    <input type="hidden" name="landlord_id" value="<?php echo $row['landlord_id']; ?>">
                                                    <button class="btn btn-warning btn-sm" name="warning_level" value="1" onclick="addWarning(this)" <?php echo $row['warning_count'] >= 1 ? 'disabled' : ''; ?>>1</button>
                                                    <button class="btn btn-warning btn-sm" name="warning_level" value="2" onclick="addWarning(this)" <?php echo $row['warning_count'] >= 2 ? 'disabled' : ''; ?>>2</button>
                                                    <button class="btn btn-warning btn-sm" name="warning_level" value="3" onclick="addWarning(this)" <?php echo $row['warning_count'] >= 3 ? 'disabled' : ''; ?>>3</button>
                                                    <button class="btn btn-danger btn-sm" name="terminate_landlord" <?php echo $row['warning_count'] < 3 ? 'disabled' : ''; ?>>Terminate</button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No landlords found!</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    // Function to add warning
    function addWarning(button) {
        var warningCount = parseInt(button.value);
        var terminateButton = button.parentElement.querySelector('button[name="terminate_landlord"]');
        terminateButton.disabled = (warningCount < 3); // Enable terminate button if warning count is 3 or more
    }
</script>
