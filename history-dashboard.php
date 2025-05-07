<?php
// Include your header file and other necessary logic here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>History Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        .top-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
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

            .top-controls {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .card-columns {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <?php include './Include/header_history.php'; ?>
    </div>

    <div class="content">
        <h1 class="text-center my-4">Project and Procurement Dashboard</h1>

        <div class="top-controls">
            <!-- Optional top controls (if any) go here -->
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Card 1 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './project-approval.php';">
                    <img src="./Images/historydash1.jpg" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Past Transactions</h5>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col">
                <div class="card" onclick="window.location.href = './purchase-req.php';">
                    <img src="./Images/historydash2.jpeg" alt="Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Supplier Performance Records</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" onclick="window.location.href = './purchase-req.php';">
                    <img src="./Images/historydash3.jpg" alt="Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Procurement Logs</h5>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>

</body>
</html>
