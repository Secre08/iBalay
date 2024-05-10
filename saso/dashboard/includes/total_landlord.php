<div class="col-xxl-4 col-xl-12">
        <div class="card info-card landlords-card">
            <div class="card-body">
                <h5 class="card-title">Total Landlords</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                        <?php
                        // Database configuration
                        include('../../database/config.php');

                        // Function to get total landlords
                        function getTotalLandlords($conn)
                        {
                            $query = "SELECT COUNT(*) AS total_landlords FROM landlord_acc";
                            $result = $conn->query($query);

                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                return $row['total_landlords'];
                            } else {
                                return 0;
                            }
                        }

                        // Call the function to get the total number of landlords
                        $totalLandlords = getTotalLandlords($conn);
                        ?>
                        <h6><?php echo $totalLandlords; ?></h6>
                        <!-- You can add additional information here if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Landlords Card -->