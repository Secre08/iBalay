<div class="col-xxl-4 col-xl-12">
    <div class="card info-card landlords-card">
        <div class="card-body">
            <h5 class="card-title">Total Boarding Houses</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-house"></i>
                </div>
                <div class="ps-3">
                    <?php
                    // Function to get total boarding houses
                    include('../../database/config.php');

                    function getTotalBoardingHouses($conn)
                    {
                        $query = "SELECT COUNT(*) AS total_boarding_houses FROM bh_information  WHERE Status = '1'";
                        $result = $conn->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            return $row['total_boarding_houses'];
                        } else {
                            return 0;
                        }
                    }

                    // Call the function to get the total number of boarding houses
                    $totalBoardingHouses = getTotalBoardingHouses($conn);
                    ?>
                    <h6><?php echo $totalBoardingHouses; ?></h6>
                    <!-- You can add additional information here if needed -->
                </div>
            </div>
        </div>
    </div>
</div><!-- End Landlords Card -->
