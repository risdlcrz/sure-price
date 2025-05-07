<?php
// Simulated data with more realistic prices in Philippine Peso (PHP)
// Prices are adjusted to reflect current material prices in the Philippines

$suppliers = [
    ['company' => 'ABC Corp', 'materials' => 'Steel, Copper', 'price' => 130000, 'rating' => 4.5],  // 2500 USD -> ~130000 PHP
    ['company' => 'XYZ Ltd', 'materials' => 'Aluminum, Zinc', 'price' => 85000, 'rating' => 3.9],   // 1600 USD -> ~85000 PHP
    ['company' => 'LMN Inc', 'materials' => 'Plastic, Rubber', 'price' => 100000, 'rating' => 4.2],  // 1800 USD -> ~100000 PHP
    ['company' => 'Delta Traders', 'materials' => 'Glass, Fiber', 'price' => 105000, 'rating' => 4.0],  // 2000 USD -> ~105000 PHP
    ['company' => 'Omega Supplies', 'materials' => 'Wood, Cement', 'price' => 90000, 'rating' => 4.6],   // 1700 USD -> ~90000 PHP
    ['company' => 'Alpha Industries', 'materials' => 'Copper, Zinc', 'price' => 160000, 'rating' => 4.7],  // 3200 USD -> ~160000 PHP
    ['company' => 'Beta Tech', 'materials' => 'Rubber, Steel', 'price' => 70000, 'rating' => 4.1],    // 1400 USD -> ~70000 PHP
    ['company' => 'Gamma Solutions', 'materials' => 'Glass, Cement', 'price' => 65000, 'rating' => 3.7], // 1300 USD -> ~65000 PHP
    ['company' => 'Epsilon Co', 'materials' => 'Wood, Aluminum', 'price' => 110000, 'rating' => 4.4],  // 2100 USD -> ~110000 PHP
    ['company' => 'Zeta Trading', 'materials' => 'Plastic, Copper', 'price' => 120000, 'rating' => 4.0],  // 2200 USD -> ~120000 PHP
    ['company' => 'Eta Suppliers', 'materials' => 'Rubber, Zinc', 'price' => 75000, 'rating' => 3.8],   // 1500 USD -> ~75000 PHP
    ['company' => 'Theta Enterprises', 'materials' => 'Wood, Glass', 'price' => 140000, 'rating' => 4.3],  // 2700 USD -> ~140000 PHP
    ['company' => 'Iota Ltd', 'materials' => 'Cement, Steel', 'price' => 130000, 'rating' => 4.2],  // 2600 USD -> ~130000 PHP
    ['company' => 'Kappa Industries', 'materials' => 'Aluminum, Rubber', 'price' => 150000, 'rating' => 4.5],  // 3000 USD -> ~150000 PHP
    ['company' => 'Lambda Supplies', 'materials' => 'Copper, Glass', 'price' => 105000, 'rating' => 4.0]  // 2000 USD -> ~105000 PHP
];

// Sort suppliers by price based on the 'order' parameter (ascending or descending)
$order = $_GET['order'] ?? 'asc';
usort($suppliers, function ($a, $b) use ($order) {
    return $order === 'asc' ? $a['price'] <=> $b['price'] : $b['price'] <=> $a['price'];
});

$next_order = $order === 'asc' ? 'desc' : 'asc';

// Sort suppliers by rating in descending order to get the top-rated ones
usort($suppliers, function ($a, $b) {
    return $b['rating'] <=> $a['rating'];
});

// Extract the top 6 unique suppliers by rating
$topSuppliers = array_slice($suppliers, 0, 6);

// Extract the ratings for the graphs
$labels = array_column($suppliers, 'company');
$ratings = array_column($suppliers, 'rating');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Rankings and Performance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
        }

        .sidebar {
            width: 250px;
            padding: 10px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: transparent;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        h1 {
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #02912d;
            color: #000;
            text-align: left;
            padding: 12px 15px;
        }

        td {
            padding: 12px 15px;
        }

        .sort-btn {
            float: right;
            padding: 10px 20px;
            background: transparent;
            border: none;
            font-size: 16px;
            color: #333;
            position: relative;
        }

        .sort-btn::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: green;
            transition: width 0.4s ease;
        }

        .sort-btn:hover::after {
            width: 100%;
        }

        .graph-section {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .left-table {
            flex: 3;
        }

        .right-graph {
            flex: 2;
        }

        .chart-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .ratings-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e0e0e0;
            margin-bottom: 30px;
        }

        .rating-circles {
            padding: 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .circle-rating {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100px;
        }

        .circle-value {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .circle-label {
            font-size: 14px;
            color: #333;
            font-weight: 500;
            text-align: center;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }

            .graph-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <?php include './INCLUDE/header_analytics.php'; ?>
    </div>

    <div class="content">
        <h1 class="text-center my-4">Supplier Rankings and Performance</h1>

        <!-- Updated Circular Ratings Section -->
        <div class="ratings-container">
            <div class="rating-circles">
                <?php
                $colors = ['#004c5f', '#00a8cc', '#aaffc3', '#009e7f', '#b8e986', '#a0c8a0'];
                $i = 0;
                foreach ($topSuppliers as $supplier):
                    $circleColor = $colors[$i % count($colors)];
                ?>
                    <div class="circle-rating text-center">
                        <div class="circle-label" style="font-weight: bold;"><?= htmlspecialchars($supplier['company']) ?></div>
                        <div class="circle-value" style="background-color: <?= $circleColor ?>;">
                            <?= number_format($supplier['rating'], 1) ?>
                        </div>
                        <div class="circle-label">Rating</div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
            <a href="?order=<?= $next_order ?>" class="sort-btn">
                <i class="fas fa-sort-amount-<?= $order === 'asc' ? 'up' : 'down' ?>"></i> Sort by Price
            </a>
        </div>

        <div class="graph-section">
            <div class="left-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Materials</th>
                            <th>Price (PHP)</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suppliers as $supplier): ?>
                            <tr>
                                <td><?= htmlspecialchars($supplier['company']) ?></td>
                                <td><?= htmlspecialchars($supplier['materials']) ?></td>
                                <td>₱<?= number_format($supplier['price'], 2) ?></td> <!-- Display price in PHP -->
                                <td><?= number_format($supplier['rating'], 1) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="right-graph">
                <div class="chart-container">
                    <canvas id="lineChart"></canvas>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const labels = <?= json_encode(array_column($suppliers, 'company')) ?>;
        const ratings = <?= json_encode(array_column($suppliers, 'rating')) ?>;

        const configLine = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rating Trend',
                    data: ratings,
                    fill: false,
                    borderColor: 'green',
                    tension: 0.1
                }]
            }
        };

        const configBar = {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Company Rating',
                    data: ratings,
                    backgroundColor: 'rgba(2,145,45,0.7)',
                    borderColor: 'rgba(2,145,45,1)',
                    borderWidth: 1
                }]
            }
        };

        new Chart(document.getElementById('lineChart'), configLine);
        new Chart(document.getElementById('barChart'), configBar);
    </script>
</body>
</html>