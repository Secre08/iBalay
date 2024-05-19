<div class="col-xxl-4 col-md-6">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Female Boarders</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-gender-female " style="color: pink;"h ></i>
                </div>
                <div class="ps-3">
                    <?php
                    include('../../database/config.php');

                    // Function to fetch total female boarders
                    function getTotalFemaleBoarders($conn)
                    {
                        $query = "SELECT COUNT(*) AS female_count FROM tenant WHERE gender = 'Female'";
                        $result = $conn->query($query);
                    
                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            return $row['female_count'];
                        } else {
                            return 0;
                        }
                    }

                    // Call the function to get total female boarders
                    $femaleCount = getTotalFemaleBoarders($conn);
                    ?>
                    <h6><?php echo $femaleCount; ?></h6>
                    <span class="text-success small pt-1 fw-bold"></span>
                    <span class="text-muted small pt-2 ps-1">Total</span>
                </div>
            </div>
        </div>
    </div>
</div>
