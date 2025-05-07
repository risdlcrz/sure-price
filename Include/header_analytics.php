<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Responsive Admin Sidebar</title>
  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./Styles/header.css">
</head>
<body>

  <!-- Mobile Top Header -->
  <div class="mobile-topbar d-md-none d-flex">
    <div class="d-flex align-items-center gap-2">
      <img src="./Images/gdc_logo.png" alt="Logo" style="height: 40px;">
      <strong>GEOCON</strong>
    </div>
    <button class="btn btn-success" onclick="toggleMobileMenu()">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <!-- Mobile Fullscreen Menu -->
  <div class="mobile-menu" id="mobileMenu">
    <div class="logo-close-container d-flex justify-content-between align-items-start w-100 mb-4">
      <div class="text-start d-flex flex-column align-items-center">
        <img src="./Images/gdc_logo.png" alt="Logo" style="height: 100px;">
        <div style="font-size: 35px; font-weight: bold;">GEOCON</div>
      </div>
      <button class="close-btn-mobile" onclick="toggleMobileMenu()">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div class="w-100 d-flex flex-column align-items-center mt-2 mobile-nav-buttons">
        <button onclick="location.href='dbadmin.php'"><i class="fas fa-home"></i>Dashboard</button>
        <button onclick="location.href='purchase-order.php'"><i class="fas fa-file-invoice-dollar"></i>Active Purchase Order</button>
        <button onclick="location.href='budget-allocation.php'"><i class="fas fa-coins"></i>Budget Allocation and Expenditures</button>
        <button onclick="location.href='supplier-rankings.php'"><i class="fas fa-ranking-star"></i>Supplier Rankings and Performance</button>
        <button onclick="location.href='price-analysis.php'"><i class="fas fa-chart-line"></i>Price Trend Analysis</button>
    </div>
  </div>

  <!-- Desktop Sidebar -->
  <div class="left-header d-none d-md-flex">
    <div class="logo-title-container">
      <img src="./Images/gdc_logo.png" alt="Company Logo" class="header-logo">
      <div class="header-title">GEOCON</div>
    </div>

    <div class="separator"></div>

    <div class="profile-section">
      <div class="label">Logged in as</div>
      <div class="username">BakaRenejay'to</div>
      <i class="fas fa-user-circle profile-icon"></i>
    </div>

    <div class="separator"></div>

    <div class="nav-buttons">
    <button onclick="location.href='dbadmin.php'"><i class="fas fa-home"></i>Dashboard</button>
        <button onclick="location.href='purchase-order.php'"><i class="fas fa-file-invoice-dollar"></i>Active Purchase Order</button>
        <button onclick="location.href='budget-allocation.php'"><i class="fas fa-coins"></i>Budget Allocation and Expenditures</button>
        <button onclick="location.href='supplier-rankings.php'"><i class="fas fa-ranking-star"></i>Supplier Rankings and Performance</button>
        <button onclick="location.href='price-analysis.php'"><i class="fas fa-chart-line"></i>Price Trend Analysis</button>
    </div>

    <div style="margin-top: auto; width: 100%;">
      <div class="separator"></div>
      <div class="nav-buttons">
        <button onclick="location.href='login.php'"><i class="fas fa-sign-out-alt"></i>Logout</button>
      </div>
    </div>
  </div>

  <script src="./Script/header.js"></script>

</body>
</html>