<main id="main" class="main">
    <div class="pagetitle"> 
        <h1>Account Confirmation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accounts List</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Account List</h5>

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
                    <?php
                    include('../../database/config.php');
                    $sql = "SELECT `first_name`, `last_name`, `email` FROM `landlord_acc` WHERE `approval_status` = 0";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>
                                    <form method='post' action='views/tasks/accounts_save.php'>
                                        <input type='hidden' name='email' value='" . $row['email'] . "'>
                                        <button type='submit' class='btn btn-primary' name='confirm'>Confirm</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No landlord accounts pending confirmation!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div><!-- End card -->
</main><!-- End #main -->
