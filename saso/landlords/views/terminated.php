<main id="main" class="main">
    <div class="pagetitle"> 
        <h1>List of Terminated Account</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Terminated List</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Terminated List</h5>

            <table class="table datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection and execute SQL query
                    include('../../database/config.php');

                    
                    $query = "SELECT la.`first_name`, la.`last_name`, la.`email`
                              FROM `bh_information` AS bh
                              JOIN `landlord_acc` AS la ON bh.`landlord_id` = la.`landlord_id`
                              WHERE bh.`Status` = '3'";
                    $result = mysqli_query($conn, $query);
                    $count = 1;
                    
                    // Check if there are terminated landlords
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each terminated landlord and display their information
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No terminated landlords available
                        echo "<tr><td colspan='5'>No terminated landlords available!</td></tr>";
                    }
                    
                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div><!-- End card -->
</main><!-- End #main -->
