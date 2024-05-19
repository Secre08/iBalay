<div class="col-xxl-4 col-xl-6">
    <div class="card info-card revenue-card">
        <div class="card-body">
            <h5 class="card-title"><a href="#" style="color: #00008B;">Pending BH</a></h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-houses-fill"></i>
                </div>
                <div class="ps-3">
                    <?php
                    // Database configuration
                    include('../../database/config.php');

                    // Function to fetch total pending boarding houses
                    function getTotalPendingBoardingHouses($conn)
                    {
                        $query = "SELECT COUNT(*) AS pending_count FROM bh_information WHERE Status IS NULL OR Status = '0'";
                        $result = $conn->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            return $row['pending_count'];
                        } else {
                            return 0;
                        }
                    }

                    // Call the function to get total pending boarding houses
                    $pendingCount = getTotalPendingBoardingHouses($conn);

                    // Close the database connection
                    $conn->close();
                    ?>
                    <h6><?php echo $pendingCount; ?></h6>
                    <span class="text-success small pt-1 fw-bold"></span>
                    <span class="text-muted small pt-2 ps-1">Total</span>
                </div>
            </div>
        </div>
    </div>
</div>
