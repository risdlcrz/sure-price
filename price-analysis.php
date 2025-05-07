<?php
// You can connect to your database here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Price Trend Analysis</title>
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
      overflow-x: hidden;
    }

    .dashboard-box {
      display: flex;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
      overflow: hidden;
      flex-direction: column;
    }

    .price-trend-container {
      padding: 20px;
      border-bottom: 1px solid #ccc;
    }

    .table-container {
      padding: 20px;
    }

    .table th, .table td {
      vertical-align: middle;
      padding: 8px 12px;
    }

    .table {
      border-radius: 10px;
      overflow: hidden;
      border: 1px solid #ddd;
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

      .dashboard-box {
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
    <h1 class="text-center my-4">Price Trend Analysis</h1>

    <div class="dashboard-box">
      <div class="price-trend-container">
        <h5>Price Trend (PHP)</h5>
        <canvas id="priceTrendChart" height="100"></canvas>
      </div>

      <div class="table-container">
        <h5>Product Prices</h5>
        <table class="table table-bordered bg-white">
          <thead>
            <tr>
              <th>Product</th>
              <th>Last Price (PHP)</th>
              <th>Updated Price (PHP)</th>
              <th>Price Change</th>
            </tr>
          </thead>
          <tbody id="productPriceTable">
            <!-- Simulated data -->
            <tr>
              <td>Paint - White</td>
              <td>500</td>
              <td>450</td>
              <td class="price-change" style="color: green;">-50</td>
            </tr>
            <tr>
              <td>Brush - Large</td>
              <td>250</td>
              <td>270</td>
              <td class="price-change" style="color: red;">+20</td>
            </tr>
            <tr>
              <td>Tape - 1in</td>
              <td>150</td>
              <td>140</td>
              <td class="price-change" style="color: green;">-10</td>
            </tr>
            <tr>
              <td>Paint - Blue</td>
              <td>600</td>
              <td>620</td>
              <td class="price-change" style="color: red;">+20</td>
            </tr>
            <tr>
              <td>Brush - Small</td>
              <td>200</td>
              <td>190</td>
              <td class="price-change" style="color: green;">-10</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('priceTrendChart').getContext('2d');
    const productData = [
      { product: 'Paint - White', lastPrice: 500, updatedPrice: 450 },
      { product: 'Brush - Large', lastPrice: 250, updatedPrice: 270 },
      { product: 'Tape - 1in', lastPrice: 150, updatedPrice: 140 },
      { product: 'Paint - Blue', lastPrice: 600, updatedPrice: 620 },
      { product: 'Brush - Small', lastPrice: 200, updatedPrice: 190 },
    ];

    const labels = productData.map(data => data.product);
    const lastPrices = productData.map(data => data.lastPrice);
    const updatedPrices = productData.map(data => data.updatedPrice);

    const priceTrendChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Price Trend (PHP)',
          data: updatedPrices,
          borderColor: '#007bff',
          backgroundColor: 'rgba(0, 123, 255, 0.1)',
          tension: 0.4,
          fill: true,
          pointRadius: 6,
        }, {
          label: 'Last Price (PHP)',
          data: lastPrices,
          borderColor: '#dc3545',
          backgroundColor: 'rgba(220, 53, 69, 0.1)',
          tension: 0.4,
          fill: true,
          pointRadius: 6,
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false,
            ticks: {
              stepSize: 50,
            }
          }
        }
      }
    });

    const priceChangeElements = document.querySelectorAll('.price-change');
    priceChangeElements.forEach((el, index) => {
      const lastPrice = productData[index].lastPrice;
      const updatedPrice = productData[index].updatedPrice;
      const priceChange = updatedPrice - lastPrice;

      el.textContent = priceChange;
      el.style.color = priceChange < 0 ? 'green' : 'red';
    });
  </script>
</body>
</html>
