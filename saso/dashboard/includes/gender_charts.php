<?php
// Include your database connection file
include('../../database/config.php');

// Your SQL queries to count male and female tenants
$sqlMaleCount = "SELECT COUNT(*) AS maleCount FROM tenant WHERE Gender = 'Male' AND checked_out = 0";
$sqlFemaleCount = "SELECT COUNT(*) AS femaleCount FROM tenant WHERE Gender = 'Female' AND checked_out = 0";

$resultMaleCount = mysqli_query($conn, $sqlMaleCount);
$resultFemaleCount = mysqli_query($conn, $sqlFemaleCount);

if ($resultMaleCount && $resultFemaleCount) {
    $rowMaleCount = mysqli_fetch_assoc($resultMaleCount);
    $rowFemaleCount = mysqli_fetch_assoc($resultFemaleCount);

    $maleCount = $rowMaleCount['maleCount'];
    $femaleCount = $rowFemaleCount['femaleCount'];
} else {
    // Handle the error if the queries fail
    $maleCount = 0;
    $femaleCount = 0;
}

// Close the database connection if needed
mysqli_close($conn);

// Check if both male and female counts are zero
if ($maleCount == 0 && $femaleCount == 0) {
    $message = "No boarders yet";
} else {
    $message = "";
}
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Boarders | Gender Chart</h5>
            <?php if (!empty($message)) { ?>
                <div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
            <?php } ?>

            <div id="pieChart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#pieChart"), {
                        series: [<?php echo $maleCount; ?>, <?php echo $femaleCount; ?>],
                        chart: {
                            height: 350,
                            type: 'pie',
                            toolbar: {
                                show: true
                            }
                        },
                        labels: ['Male Boarders', 'Female Boarders'],
                        colors: ['#1E90FF', '#FF69B4']
                    }).render();
                });
            </script>
        </div>
    </div>
</div>
