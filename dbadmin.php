<?php
// Include your header file and other necessary logic here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./Styles/dbadmin.css">
</head>
<body>
    
    <div class="sidebar">
        <?php include './Include/header.php'; ?>
    </div>

    <div class="content">
        <h1 class="text-center my-4">Admin Dashboard</h1>

        <div class="top-controls">
            <!-- Optional top controls (if any) go here -->
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Card 1 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './information-management.php';">
                    <img src="./Images/imagecard1.jpg" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Information Management</h5>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './notification-center.php';">
                    <img src="./Images/imagecard2.jpg" alt="Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Centralized Notification Hub</h5>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './project-dashboard.php';">
                    <img src="./Images/imagecard3.jpg" alt="Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Project and Procurement Request</h5>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './history-dashboard.php';">
                    <img src="./Images/imagecard4.jpg" alt="Image 4">
                    <div class="card-body">
                        <h5 class="card-title">Project History and Reports</h5>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './analytics-dashboard.php';">
                    <img src="./Images/imagecard5.jpg" alt="Image 5">
                    <div class="card-body">
                        <h5 class="card-title">Analytics and Recommendations</h5>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './inventory-management.php';">
                    <img src="./Images/imagecard6.jpg" alt="Image 6">
                    <div class="card-body">
                        <h5 class="card-title">Inventory Management</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
