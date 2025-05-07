<?php
// Include your header file and other necessary logic here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Budget Allocation and Expenditures</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: transparent;
            padding: 20px;
            height: 100vh;
            color: #fff;
            position: fixed;
            width: 250px;
            transition: all 0.3s ease;
        }

        .sidebar a {
            color: transparent;
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #444;
        }

        /* Content Styling */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        /* Heading Styling */
        h1, h4 {
            color: #333;
        }

        /* Transaction List Styling */
        .list-group-item {
            border: none;
            font-size: 14px;
            padding: 10px;
            margin-bottom: 5px;
        }

        .list-group-item:nth-child(odd) {
            background-color: #f9f9f9;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                width: 100%;
                height: auto;
                padding: 10px;
                z-index: 999;
            }

            .content {
                margin-left: 0;
                padding: 10px;
            }

            .row {
                display: block;
            }

            /* Ensure recent transaction doesn't overflow */
            .col-md-4 {
                margin-top: 20px; /* Give some space above */
            }

            .list-group-item {
                font-size: 12px; /* Slightly smaller font */
            }

            /* Adjust Graph Heights for Smaller Screens */
            canvas {
                height: 150px; /* Further reduced graph height for smaller screens */
            }

            .card {
                margin-bottom: 20px;
            }

            .row-cols-md-3 .col-md-4 {
                width: 100%;
            }
        }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar">
            <?php include './Include/header_analytics.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 content">
            <h1 class="text-center my-4">Budget Allocation and Expenditures</h1>

            <div class="row mb-4">
                <div class="col-md-8">
                    <h4>Spending This Month</h4>
                    <div style="height: 300px;">
                        <canvas id="spendingChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>Recent Transactions</h4>
                    <div class="list-group">
                        <?php
                        $transactions = [
                            ['2025-04-01', 'Office Supplies', 5000],
                            ['2025-04-05', 'Transportation', 3200],
                            ['2025-04-10', 'Utilities', 4500],
                            ['2025-04-15', 'Miscellaneous', 2750],
                            ['2025-04-20', 'Office Supplies', 6000]
                        ];
                        foreach ($transactions as [$date, $desc, $amount]) {
                            echo "<div class='list-group-item d-flex justify-content-between'>
                                    <div><strong>$date</strong><br>$desc</div>
                                    <div>₱" . number_format($amount, 0) . "</div>
                                  </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Cost Breakdown Chart -->
                <div class="col-md-8 mb-4">
                    <h4>Cost Breakdown</h4>
                    <div style="height: 300px;">
                        <canvas id="costBreakdownChart"></canvas>
                    </div>
                </div>

                <!-- Budget Tracking -->
                <div class="col-md-4">
                    <h4>Budget Tracking</h4>
                    <div class="card p-3">
                        <?php
                        $totalBudget = 50000;
                        $totalSpent = 27500;
                        $remaining = $totalBudget - $totalSpent;
                        $spentPercent = round(($totalSpent / $totalBudget) * 100);
                        ?>
                        <!-- Budget Used -->
                        <p><strong><?= $spentPercent ?>% of Budget Used</strong></p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $spentPercent ?>%;" aria-valuenow="<?= $spentPercent ?>" aria-valuemin="0" aria-valuemax="100">
                                <?= $spentPercent ?>%
                            </div>
                        </div>
                        
                        <!-- Budget Breakdown -->
                        <div class="d-flex justify-content-between">
                            <p><strong>Total Budget:</strong> ₱<?= number_format($totalBudget, 0) ?></p>
                            <p><strong>Total Spent:</strong> ₱<?= number_format($totalSpent, 0) ?></p>
                            <p><strong>Remaining:</strong> ₱<?= number_format($remaining, 0) ?></p>
                        </div>
                        
                        <!-- Status -->
                        <?php if ($totalSpent > $totalBudget): ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <strong>Over Budget!</strong> You have exceeded your budget by ₱<?= number_format($totalSpent - $totalBudget, 0) ?>.
                            </div>
                        <?php elseif ($remaining > 0): ?>
                            <div class="alert alert-success mt-3" role="alert">
                                <strong>Under Budget!</strong> You still have ₱<?= number_format($remaining, 0) ?> remaining.
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                <strong>Budget Balanced!</strong> You have exactly used up your budget.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div> <!-- End of Content -->
    </div> <!-- End of Row -->
</div> <!-- End of Container -->

<!-- Chart.js Configs -->
<script>
    const spendingChart = new Chart(document.getElementById('spendingChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Apr 1', 'Apr 5', 'Apr 10', 'Apr 15', 'Apr 20', 'Apr 25'],
            datasets: [{
                label: 'PHP Spent',
                data: [5000, 8200, 12700, 15450, 21450, 27500],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => '₱' + value
                    }
                }
            }
        }
    });

    const costBreakdownChart = new Chart(document.getElementById('costBreakdownChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Office Supplies', 'Transportation', 'Utilities', 'Miscellaneous'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

</body>
</html>
