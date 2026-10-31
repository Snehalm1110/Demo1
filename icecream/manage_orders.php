<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$con = mysqli_connect("localhost", "root", "", "icecream");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = '';
$error = '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Handle status update
if (isset($_POST['update_status'])) {
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    $sql = "UPDATE user_order SET order_status = '$status' WHERE order_id = '$order_id'";
    if (mysqli_query($con, $sql)) {
        $message = "✓ Order status updated to: " . ucfirst($status);
    } else {
        $error = "Error updating status: " . mysqli_error($con);
    }
}

// Get orders with filter
if ($filter == 'pending') {
    $orders = mysqli_query($con, "
        SELECT uo.*, r.name, r.email, r.contact, r.address 
        FROM user_order uo 
        LEFT JOIN registration r ON uo.user_id = r.id 
        WHERE uo.order_status = 'pending' 
        ORDER BY uo.order_date DESC, uo.order_id DESC
    ");
} else if ($filter == 'confirmed') {
    $orders = mysqli_query($con, "
        SELECT uo.*, r.name, r.email, r.contact, r.address 
        FROM user_order uo 
        LEFT JOIN registration r ON uo.user_id = r.id 
        WHERE uo.order_status = 'confirmed' 
        ORDER BY uo.order_date DESC, uo.order_id DESC
    ");
} else if ($filter == 'delivered') {
    $orders = mysqli_query($con, "
        SELECT uo.*, r.name, r.email, r.contact, r.address 
        FROM user_order uo 
        LEFT JOIN registration r ON uo.user_id = r.id 
        WHERE uo.order_status = 'delivered' 
        ORDER BY uo.order_date DESC, uo.order_id DESC
    ");
} else {
    $orders = mysqli_query($con, "
        SELECT uo.*, r.name, r.email, r.contact, r.address 
        FROM user_order uo 
        LEFT JOIN registration r ON uo.user_id = r.id 
        ORDER BY uo.order_date DESC, uo.order_id DESC
    ");
}

// Get statistics
$pending_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM user_order WHERE order_status = 'pending'"))['count'];
$confirmed_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM user_order WHERE order_status = 'confirmed'"))['count'];
$delivered_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM user_order WHERE order_status = 'delivered'"))['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - iCREAM Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-ice-cream"></i> iCREAM Admin</h2>
        </div>
        
        <nav class="sidebar-nav">
            <a href="admin_dashboard.php" class="nav-item">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="manage_products.php" class="nav-item">
                <i class="fas fa-box"></i> Products
            </a>
            <a href="manage_categories.php" class="nav-item">
                <i class="fas fa-list"></i> Categories
            </a>
            <a href="manage_orders.php" class="nav-item active">
                <i class="fas fa-shopping-cart"></i> Orders
            </a>
            <a href="manage_users.php" class="nav-item">
                <i class="fas fa-users"></i> Users
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <a href="admin_logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-title">
                <h1>Manage Orders</h1>
                <p>View, confirm and deliver customer orders</p>
            </div>
        </div>
        
        <!-- Messages -->
        <?php if ($message): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <!-- Order Statistics -->
        <section class="stats-section" style="margin-bottom: 30px;">
            <div class="stat-card" style="cursor: pointer;" onclick="location.href='manage_orders.php?filter=all'">
                <div class="stat-icon orders">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-content">
                    <h3>All Orders</h3>
                    <p class="stat-number" id="total-orders">0</p>
                </div>
            </div>
            
            <div class="stat-card" <?php echo $filter === 'pending' ? 'style="background: #fff3cd;"' : ''; ?> onclick="location.href='manage_orders.php?filter=pending'">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>Pending Confirmation</h3>
                    <p class="stat-number"><?php echo $pending_count; ?></p>
                </div>
            </div>
            
            <div class="stat-card" onclick="location.href='manage_orders.php?filter=confirmed'">
                <div class="stat-icon orders">
                    <i class="fas fa-check"></i>
                </div>
                <div class="stat-content">
                    <h3>Confirmed Orders</h3>
                    <p class="stat-number"><?php echo $confirmed_count; ?></p>
                </div>
            </div>
            
            <div class="stat-card" onclick="location.href='manage_orders.php?filter=delivered'">
                <div class="stat-icon orders">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-content">
                    <h3>Delivered</h3>
                    <p class="stat-number"><?php echo $delivered_count; ?></p>
                </div>
            </div>
        </section>
        
        <!-- Filter Tabs -->
        <section class="content-section">
            <div class="filter-tabs" style="margin-bottom: 20px; display: flex; gap: 10px; border-bottom: 2px solid #e0e5eb; padding-bottom: 15px;">
                <a href="manage_orders.php?filter=all" class="filter-tab <?php echo $filter === 'all' ? 'active' : ''; ?>" style="padding: 8px 15px; border-radius: 4px; text-decoration: none; <?php echo $filter === 'all' ? 'background: #667eea; color: white;' : 'color: #666;'; ?>">
                    All Orders
                </a>
                <a href="manage_orders.php?filter=pending" class="filter-tab <?php echo $filter === 'pending' ? 'active' : ''; ?>" style="padding: 8px 15px; border-radius: 4px; text-decoration: none; <?php echo $filter === 'pending' ? 'background: #ff9800; color: white;' : 'color: #666;'; ?>">
                    <i class="fas fa-exclamation-circle"></i> Pending (<?php echo $pending_count; ?>)
                </a>
                <a href="manage_orders.php?filter=confirmed" class="filter-tab <?php echo $filter === 'confirmed' ? 'active' : ''; ?>" style="padding: 8px 15px; border-radius: 4px; text-decoration: none; <?php echo $filter === 'confirmed' ? 'background: #2196F3; color: white;' : 'color: #666;'; ?>">
                    <i class="fas fa-check"></i> Confirmed (<?php echo $confirmed_count; ?>)
                </a>
                <a href="manage_orders.php?filter=delivered" class="filter-tab <?php echo $filter === 'delivered' ? 'active' : ''; ?>" style="padding: 8px 15px; border-radius: 4px; text-decoration: none; <?php echo $filter === 'delivered' ? 'background: #4CAF50; color: white;' : 'color: #666;'; ?>">
                    <i class="fas fa-check-double"></i> Delivered (<?php echo $delivered_count; ?>)
                </a>
            </div>
            
            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item Name</th>
                            <th>Customer Name</th>
                            <th>Contact</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Order Date</th>
                            <th>Current Status</th>
                            <th>Action - Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($orders) > 0) {
                            while ($order = mysqli_fetch_assoc($orders)) {
                                $status = $order['order_status'] ?? 'pending';
                                $status_class = strtolower($status);
                                $customer_name = $order['name'] ?? 'Guest User';
                                $customer_contact = $order['contact'] ?? 'N/A';
                                $order_date = date('M d, Y h:i A', strtotime($order['order_date'] ?? 'now'));
                                
                                echo "
                                <tr>
                                    <td><strong>#" . $order['order_id'] . "</strong></td>
                                    <td>" . $order['Item_name'] . "</td>
                                    <td>" . $customer_name . "</td>
                                    <td>" . $customer_contact . "</td>
                                    <td>₹" . $order['Price'] . "</td>
                                    <td>" . $order['Quantity'] . "</td>
                                    <td><small>" . $order_date . "</small></td>
                                    <td><span class='status-badge " . $status_class . "'>" . ucfirst($status) . "</span></td>
                                    <td>
                                        <form method='POST' style='display: inline;'>
                                            <input type='hidden' name='order_id' value='" . $order['order_id'] . "'>
                                            <div style='display: flex; gap: 5px;'>
                                                <select name='status' class='status-select' style='padding: 6px; font-size: 12px;'>
                                                    <option value='pending' " . ($status == 'pending' ? 'selected' : '') . ">⏳ Pending</option>
                                                    <option value='confirmed' " . ($status == 'confirmed' ? 'selected' : '') . ">✓ Confirmed</option>
                                                    <option value='shipped' " . ($status == 'shipped' ? 'selected' : '') . ">📦 Shipped</option>
                                                    <option value='delivered' " . ($status == 'delivered' ? 'selected' : '') . ">✓✓ Delivered</option>
                                                    <option value='cancelled' " . ($status == 'cancelled' ? 'selected' : '') . ">✕ Cancelled</option>
                                                </select>
                                                <button type='submit' name='update_status' class='btn-small btn-update' title='Update Status'>
                                                    <i class='fas fa-save'></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='9' style='text-align: center; color: #999; padding: 30px;'><i class='fas fa-inbox'></i> No orders found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <!-- Order Workflow Info -->
        <section class="content-section" style="background: #f0f4ff; border-left: 4px solid #667eea;">
            <h3 style="margin-bottom: 15px;"><i class="fas fa-info-circle"></i> Order Status Workflow</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <strong>⏳ Pending</strong><br>
                    <small>Customer placed order, awaiting your confirmation</small>
                </div>
                <div>
                    <strong>✓ Confirmed</strong><br>
                    <small>Order confirmed, ready for shipping</small>
                </div>
                <div>
                    <strong>📦 Shipped</strong><br>
                    <small>Order is on the way to customer</small>
                </div>
                <div>
                    <strong>✓✓ Delivered</strong><br>
                    <small>Order successfully delivered to customer</small>
                </div>
                <div>
                    <strong>✕ Cancelled</strong><br>
                    <small>Order has been cancelled</small>
                </div>
            </div>
        </section>
    </div>
    
    <style>
        .filter-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .filter-tab {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #ddd;
        }
        
        .filter-tab:hover {
            transform: translateY(-2px);
        }
    </style>
    
    <script>
        // Update total orders count
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.data-table tbody tr');
            // Filter out empty rows
            const orderRows = Array.from(rows).filter(row => row.cells[0].textContent.trim() !== 'No orders found');
            document.getElementById('total-orders').textContent = orderRows.length;
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - iCREAM Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-ice-cream"></i> iCREAM Admin</h2>
        </div>
        
        <nav class="sidebar-nav">
            <a href="admin_dashboard.php" class="nav-item">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="manage_products.php" class="nav-item">
                <i class="fas fa-box"></i> Products
            </a>
            <a href="manage_categories.php" class="nav-item">
                <i class="fas fa-list"></i> Categories
            </a>
            <a href="manage_orders.php" class="nav-item active">
                <i class="fas fa-shopping-cart"></i> Orders
            </a>
            <a href="manage_users.php" class="nav-item">
                <i class="fas fa-users"></i> Users
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <a href="admin_logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-title">
                <h1>Manage Orders</h1>
                <p>View and manage customer orders</p>
            </div>
        </div>
        
        <!-- Messages -->
        <?php if ($message): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <!-- Orders Section -->
        <section class="content-section">
            <div class="section-header">
                <h2>All Orders</h2>
            </div>
            
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($orders) > 0) {
                            while ($order = mysqli_fetch_assoc($orders)) {
                                $status = $order['order_status'] ?? 'pending';
                                $status_class = strtolower($status);
                                echo "
                                <tr>
                                    <td>#" . $order['order_id'] . "</td>
                                    <td>" . $order['Item_name'] . "</td>
                                    <td>₹" . $order['Price'] . "</td>
                                    <td>" . $order['Quantity'] . "</td>
                                    <td>" . date('M d, Y', strtotime($order['order_date'] ?? 'now')) . "</td>
                                    <td><span class='status-badge $status_class'>" . ucfirst($status) . "</span></td>
                                    <td>
                                        <form method='POST' style='display: inline;'>
                                            <input type='hidden' name='order_id' value='" . $order['order_id'] . "'>
                                            <select name='status' class='status-select'>
                                                <option value='pending' " . ($status == 'pending' ? 'selected' : '') . ">Pending</option>
                                                <option value='confirmed' " . ($status == 'confirmed' ? 'selected' : '') . ">Confirmed</option>
                                                <option value='shipped' " . ($status == 'shipped' ? 'selected' : '') . ">Shipped</option>
                                                <option value='delivered' " . ($status == 'delivered' ? 'selected' : '') . ">Delivered</option>
                                                <option value='cancelled' " . ($status == 'cancelled' ? 'selected' : '') . ">Cancelled</option>
                                            </select>
                                            <button type='submit' name='update_status' class='btn-small btn-update'>
                                                <i class='fas fa-check'></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align: center; color: #999;'>No orders found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    
    <style>
        .status-select {
            padding: 5px 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .btn-small {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .btn-update {
            background: #27ae60;
            color: white;
        }
        
        .btn-update:hover {
            background: #229954;
        }
    </style>
</body>
</html>
