<?php
$employees = [
    ['department' => 'Procurement', 'employee_id' => 'EMP001', 'employee_card' => 'CARD001', 'name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '1234567890', 'position' => 'Procurement Manager'],
    ['department' => 'Supplier', 'employee_id' => 'EMP002', 'employee_card' => 'CARD002', 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone' => '0987654321', 'position' => 'Supplier Coordinator'],
    ['department' => 'Warehouse', 'employee_id' => 'EMP003', 'employee_card' => 'CARD003', 'name' => 'Robert Johnson', 'email' => 'robert@example.com', 'phone' => '1122334455', 'position' => 'Warehouse Supervisor'],
    ['department' => 'Client', 'employee_id' => 'EMP004', 'employee_card' => 'CARD004', 'name' => 'Emily Davis', 'email' => 'emily@example.com', 'phone' => '2233445566', 'position' => 'Client Relations Manager'],
    ['department' => 'Procurement', 'employee_id' => 'EMP005', 'employee_card' => 'CARD005', 'name' => 'Michael Brown', 'email' => 'michael@example.com', 'phone' => '3344556677', 'position' => 'Procurement Officer'],
    ['department' => 'Supplier', 'employee_id' => 'EMP006', 'employee_card' => 'CARD006', 'name' => 'Linda Clark', 'email' => 'linda@example.com', 'phone' => '4455667788', 'position' => 'Supplier Manager'],
    ['department' => 'Warehouse', 'employee_id' => 'EMP007', 'employee_card' => 'CARD007', 'name' => 'James Miller', 'email' => 'james@example.com', 'phone' => '5566778899', 'position' => 'Warehouse Worker'],
    ['department' => 'Client', 'employee_id' => 'EMP008', 'employee_card' => 'CARD008', 'name' => 'Olivia Wilson', 'email' => 'olivia@example.com', 'phone' => '6677889900', 'position' => 'Client Support Specialist']
];

$filter = $_GET['department'] ?? 'All';
$action = $_GET['action'] ?? '';
$filtered_employees = ($filter === 'All') ? $employees : array_filter($employees, fn($e) => $e['department'] === $filter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Information</title>
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

        .filter-buttons a,
        .action-buttons a {
            margin-right: 15px;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            border: none;
            position: relative;
        }

        .filter-buttons a {
            color: #333;
            background-color: transparent;
        }

        .filter-buttons a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            color: green;
            background-color: green;
            transition: width 0.4s ease;
        }
        
        .action-buttons a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            transition: width 0.4s ease;
        }

        .filter-buttons a:hover::after,
        .filter-buttons a.active::after,
        .action-buttons a:hover::after,
        .action-buttons a.active::after {
            width: 100%;
        }

        .update-btn {
            color: #007bff;
        }

        .update-btn::after {
            background-color: #007bff;
        }

        .update-btn:hover {
            color: #0056b3;
        }

        .delete-btn {
            color: #dc3545;
        }

        .delete-btn::after {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            color: #a71d2a;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #02912d;
            color: #000;
            text-align: left;
            padding: 12px 15px;
        }

        td {
            padding: 12px 15px;
            border: none;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

        .form-check-input {
            margin-left: 5px;
        }

        .top-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
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

            .action-buttons {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <?php include './INCLUDE/header.php'; ?>
    </div>

    <div class="content">
        <h1 class="text-center my-4">Information Management</h1>

        <div class="top-controls">
            <div class="filter-buttons">
                <a href="?department=All&action=<?= $action ?>" class="<?= $filter === 'All' ? 'active' : '' ?>"><i class="fas fa-th-list"></i> All</a>
                <a href="?department=Procurement&action=<?= $action ?>" class="<?= $filter === 'Procurement' ? 'active' : '' ?>"><i class="fas fa-box"></i> Procurement</a>
                <a href="?department=Supplier&action=<?= $action ?>" class="<?= $filter === 'Supplier' ? 'active' : '' ?>"><i class="fas fa-truck"></i> Supplier</a>
                <a href="?department=Warehouse&action=<?= $action ?>" class="<?= $filter === 'Warehouse' ? 'active' : '' ?>"><i class="fas fa-warehouse"></i> Warehouse</a>
                <a href="?department=Client&action=<?= $action ?>" class="<?= $filter === 'Client' ? 'active' : '' ?>"><i class="fas fa-users"></i> Client</a>
            </div>
            <div class="action-buttons">
                <a href="?department=<?= $filter ?>&action=update" class="update-btn <?= $action === 'update' ? 'active' : '' ?>"><i class="fas fa-user-edit"></i> Update Account</a>
                <a href="?department=<?= $filter ?>&action=delete" class="delete-btn <?= $action === 'delete' ? 'active' : '' ?>"><i class="fas fa-user-times"></i> Delete Account</a>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Department</th>
                    <th>Employee ID</th>
                    <th>Employee Card</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filtered_employees as $employee): ?>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td><?= htmlspecialchars($employee['department']) ?></td>
                        <td><?= htmlspecialchars($employee['employee_id']) ?></td>
                        <td><?= htmlspecialchars($employee['employee_card']) ?></td>
                        <td><?= htmlspecialchars($employee['name']) ?></td>
                        <td><?= htmlspecialchars($employee['email']) ?></td>
                        <td><?= htmlspecialchars($employee['phone']) ?></td>
                        <td><?= htmlspecialchars($employee['position']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
