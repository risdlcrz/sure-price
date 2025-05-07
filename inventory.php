<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventory Monitoring</title>
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

    .dashboard-box {
      display: flex;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
      overflow: hidden;
    }

    .stock-bar-container {
      flex: 1 1 60%;
      padding: 20px;
    }

    .separator-line {
      width: 1px;
      background-color: #ccc;
      margin: 0 20px;
    }

    .notifications {
      flex: 1 1 40%;
      padding: 20px;
    }

    .inventory-controls {
      margin-bottom: 15px;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: center;
    }

    .inventory-controls button#toggleAll {
      order: 1;
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

    .form-check-input[type="checkbox"] {
      transform: scale(1.2);
    }

    .btn-transparent {
      background: none;
      border: none;
      color: #333;
      position: relative;
      padding: 5px 10px;
    }

    .btn-transparent::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0%;
      height: 2px;
      background-color: green;
      transition: width 0.3s ease;
    }

    .btn-transparent:hover::after {
      width: 100%;
    }

    .notifications .card-title i {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.1); opacity: 0.7; }
      100% { transform: scale(1); opacity: 1; }
    }

    .custom-switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 28px;
    }

    .custom-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .custom-switch .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 50px;
    }

    .custom-switch .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      border-radius: 50%;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: 0.4s;
    }

    .custom-switch input:checked + .slider {
      background-color: #28a745;
    }

    .custom-switch input:checked + .slider:before {
      transform: translateX(22px);
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

      .separator-line {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <?php include './INCLUDE/header.php'; ?>
  </div>

  <div class="content">
    <h1 class="text-center my-4">Inventory Monitoring</h1>

    <div class="dashboard-box">
      <div class="stock-bar-container">
        <h5>Inventory Condition (Real-Time)</h5>
        <canvas id="inventoryStatusChart" height="150"></canvas>
        <small class="text-muted">Red: Critical | Yellow: Low | Blue: Stable | Green: Excess</small>
      </div>

      <div class="separator-line"></div>

      <div class="notifications card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title mb-3">
            <i class="fas fa-bell text-warning me-2"></i>Inventory Alerts
          </h5>
          <div class="d-flex justify-content-between mb-2">
            <div><i class="fas fa-box-open text-danger me-1"></i> <strong>Out of Stock:</strong></div>
            <span id="outOfStockCount" class="badge bg-danger rounded-pill">0 SKUs</span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <div><i class="fas fa-exclamation-triangle text-warning me-1"></i> <strong>Low Stock:</strong></div>
            <span id="lowStockCount" class="badge bg-warning text-dark rounded-pill">0 SKUs</span>
          </div>
          <h6 class="mb-2 text-muted">Critical Items</h6>
          <ul class="list-group small" id="criticalItemList"></ul>
          <h6 class="mb-2 text-muted">Low Stock Items</h6>
          <ul class="list-group small" id="lowStockItemList"></ul>
        </div>
      </div>
    </div>

    <div class="inventory-controls">
      <button id="toggleAll" class="btn-transparent" title="Toggle All">
        <i class="fas fa-toggle-on"></i> Toggle All
      </button>
      <input type="text" class="form-control" placeholder="Search Product" style="max-width: 200px;">
      <select class="form-select" style="max-width: 150px;">
        <option value="">Filter</option>
        <option>Paint</option>
        <option>Brush</option>
        <option>Tape</option>
      </select>
      <button class="btn-transparent"><i class="fas fa-bell"></i> Alert</button>
      <button class="btn-transparent"><i class="fas fa-undo"></i> Restock List</button>
    </div>

    <table class="table table-bordered bg-white">
      <thead>
        <tr>
          <th>Product</th>
          <th>Total Stock</th>
          <th>Available Stock</th>
          <th>Stock Alert</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Paint - White</td><td>100</td><td>25</td><td><label class="custom-switch"><input type="checkbox" data-id="0"><span class="slider"></span></label></td></tr>
        <tr><td>Brush - Large</td><td>60</td><td>10</td><td><label class="custom-switch"><input type="checkbox" data-id="1"><span class="slider"></span></label></td></tr>
        <tr><td>Tape - 1in</td><td>30</td><td>0</td><td><label class="custom-switch"><input type="checkbox" data-id="2"><span class="slider"></span></label></td></tr>
        <tr><td>Paint - Blue</td><td>80</td><td>70</td><td><label class="custom-switch"><input type="checkbox" data-id="3"><span class="slider"></span></label></td></tr>
        <tr><td>Brush - Small</td><td>90</td><td>60</td><td><label class="custom-switch"><input type="checkbox" data-id="4"><span class="slider"></span></label></td></tr>
        <tr><td>Tape - 3in</td><td>50</td><td>20</td><td><label class="custom-switch"><input type="checkbox" data-id="5"><span class="slider"></span></label></td></tr>
        <tr><td>Roller - Long</td><td>70</td><td>0</td><td><label class="custom-switch"><input type="checkbox" data-id="6"><span class="slider"></span></label></td></tr>
        <tr><td>Thinner</td><td>100</td><td>90</td><td><label class="custom-switch"><input type="checkbox" data-id="7"><span class="slider"></span></label></td></tr>
      </tbody>
    </table>
  </div>

  <script>
    const ctx = document.getElementById('inventoryStatusChart').getContext('2d');
    const storedData = JSON.parse(localStorage.getItem('chartData') || '{"labels":[],"data":[],"colors":[]}');

    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: storedData.labels,
        datasets: [{
          label: 'Average Stock (%)',
          data: storedData.data,
          borderColor: '#28a745',
          backgroundColor: 'rgba(40, 167, 69, 0.1)',
          tension: 0.4,
          pointRadius: 6,
          pointBackgroundColor: storedData.colors
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, max: 100, ticks: { stepSize: 20 } }
        }
      }
    });

    function saveChartData() {
      const chartData = {
        labels: chart.data.labels,
        data: chart.data.datasets[0].data,
        colors: chart.data.datasets[0].pointBackgroundColor
      };
      localStorage.setItem('chartData', JSON.stringify(chartData));
    }

    function saveSwitchStates() {
      const states = {};
      document.querySelectorAll('.custom-switch input').forEach(input => {
        states[input.dataset.id] = input.checked;
      });
      localStorage.setItem('switchStates', JSON.stringify(states));
    }

    function loadSwitchStates() {
      const states = JSON.parse(localStorage.getItem('switchStates') || '{}');
      document.querySelectorAll('.custom-switch input').forEach(input => {
        if (states.hasOwnProperty(input.dataset.id)) {
          input.checked = states[input.dataset.id];
        }
      });
    }

    function updateGraphAndStats() {
      const rows = document.querySelectorAll('table tbody tr');
      const outOfStockEl = document.getElementById('outOfStockCount');
      const lowStockEl = document.getElementById('lowStockCount');
      const criticalList = document.getElementById('criticalItemList');
      const lowStockList = document.getElementById('lowStockItemList');

      let outOfStock = 0;
      let lowStock = 0;
      let totalPercentages = [];

      criticalList.innerHTML = '';
      lowStockList.innerHTML = '';

      rows.forEach(row => {
        const product = row.cells[0].textContent.trim();
        const total = parseInt(row.cells[1].textContent.trim());
        const available = parseInt(row.cells[2].textContent.trim());
        const percent = total > 0 ? (available / total) * 100 : 0;
        const alertCheckbox = row.querySelector('.custom-switch input');

        totalPercentages.push(percent);

        if (available === 0) {
          outOfStock++;
          const li = document.createElement('li');
          li.className = 'list-group-item d-flex justify-content-between align-items-center';
          li.textContent = product;
          criticalList.appendChild(li);
        } else if (available < 20 && alertCheckbox.checked) {
          lowStock++;
          const li = document.createElement('li');
          li.className = 'list-group-item d-flex justify-content-between align-items-center';
          li.textContent = product;
          lowStockList.appendChild(li);
        }
      });

      outOfStockEl.textContent = `${outOfStock} SKUs`;
      lowStockEl.textContent = `${lowStock} SKUs`;

      const average = Math.round(totalPercentages.reduce((a, b) => a + b, 0) / totalPercentages.length);
      const color = average < 20 ? '#dc3545' : average < 50 ? '#ffc107' : average < 80 ? '#0d6efd' : '#198754';
      const now = new Date().toLocaleTimeString();

      chart.data.labels.push(now);
      chart.data.datasets[0].data.push(average);
      chart.data.datasets[0].pointBackgroundColor.push(color);

      if (chart.data.labels.length > 10) {
        chart.data.labels.shift();
        chart.data.datasets[0].data.shift();
        chart.data.datasets[0].pointBackgroundColor.shift();
      }

      chart.update();
      saveChartData();
    }

    document.getElementById('toggleAll').addEventListener('click', function () {
      const checkboxes = document.querySelectorAll('.custom-switch input');
      const allChecked = Array.from(checkboxes).every(cb => cb.checked);
      checkboxes.forEach(cb => cb.checked = !allChecked);
      saveSwitchStates();
      updateGraphAndStats();
    });

    document.querySelectorAll('.custom-switch input').forEach(input => {
      input.addEventListener('change', () => {
        saveSwitchStates();
        updateGraphAndStats();
      });
    });

    loadSwitchStates();
    updateGraphAndStats();
    setInterval(updateGraphAndStats, 604800000); // Weekly update interval
  </script>
</body>
</html>
