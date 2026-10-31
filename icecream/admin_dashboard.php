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

// Get statistics
$total_users = mysqli_num_rows(mysqli_query($con, "SELECT * FROM registration"));
$total_orders = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user_order"));
$total_products = mysqli_num_rows(mysqli_query($con, "SELECT * FROM products"));
$pending_orders = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user_order WHERE order_status = 'pending'"));

// Get recent orders
$recent_orders_result = mysqli_query($con, "SELECT o.*, p.product_name FROM user_order o LEFT JOIN products p ON o.Item_name = p.product_name ORDER BY o.order_date DESC LIMIT 5");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - iCREAM</title>
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
            <a href="admin_dashboard.php" class="nav-item active">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="manage_products.php" class="nav-item">
                <i class="fas fa-box"></i> Products
            </a>
            <a href="manage_categories.php" class="nav-item">
                <i class="fas fa-list"></i> Categories
            </a>
            <a href="manage_orders.php" class="nav-item">
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
                <h1>Dashboard</h1>
                <p>Welcome, <?php echo $_SESSION['admin_name']; ?>!</p>
            </div>
            
            <div class="header-info">
                <span class="date-time" id="dateTime"></span>
            </div>
        </div>
        
        <!-- Statistics Section -->
        <section class="stats-section">
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Users</h3>
                    <p class="stat-number"><?php echo $total_users; ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon orders">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Orders</h3>
                    <p class="stat-number"><?php echo $total_orders; ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon products">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Products</h3>
                    <p class="stat-number"><?php echo $total_products; ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>Pending Orders</h3>
                    <p class="stat-number"><?php echo $pending_orders; ?></p>
                </div>
            </div>
        </section>
        
        <!-- Quick Actions -->
        <section class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="manage_products.php" class="action-btn add-product">
                    <i class="fas fa-plus"></i> Add Product
                </a>
                <a href="manage_categories.php" class="action-btn add-category">
                    <i class="fas fa-plus"></i> Add Category
                </a>
                <a href="manage_orders.php" class="action-btn manage-orders">
                    <i class="fas fa-tasks"></i> Manage Orders
                </a>
            </div>
        </section>
        
        <!-- Recent Orders -->
        <section class="recent-orders">
            <div class="section-header">
                <h2>Recent Orders</h2>
                <a href="manage_orders.php" class="view-all">View All</a>
            </div>
            
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($recent_orders_result) > 0) {
                        while ($order = mysqli_fetch_assoc($recent_orders_result)) {
                            $status_class = strtolower($order['order_status'] ?? 'pending');
                            echo "
                            <tr>
                                <td>#" . $order['order_id'] . "</td>
                                <td>" . $order['Item_name'] . "</td>
                                <td>₹" . $order['Price'] . "</td>
                                <td>" . $order['Quantity'] . "</td>
                                <td>" . date('M d, Y', strtotime($order['order_date'] ?? 'now')) . "</td>
                                <td><span class='status-badge $status_class'>" . ucfirst($order['order_status'] ?? 'pending') . "</span></td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center; color: #999;'>No orders yet</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <script>
        // Update date and time
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            document.getElementById('dateTime').textContent = now.toLocaleDateString('en-US', options);
        }
        
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>
