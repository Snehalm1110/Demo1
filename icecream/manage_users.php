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

// Get all users
$users = mysqli_query($con, "SELECT * FROM registration ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - iCREAM Admin</title>
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
            <a href="manage_orders.php" class="nav-item">
                <i class="fas fa-shopping-cart"></i> Orders
            </a>
            <a href="manage_users.php" class="nav-item active">
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
                <h1>Manage Users</h1>
                <p>View registered customers</p>
            </div>
        </div>
        
        <!-- Users Section -->
        <section class="content-section">
            <div class="section-header">
                <h2>All Registered Users</h2>
            </div>
            
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($users) > 0) {
                            while ($user = mysqli_fetch_assoc($users)) {
                                echo "
                                <tr>
                                    <td>#" . $user['id'] . "</td>
                                    <td><strong>" . $user['name'] . "</strong></td>
                                    <td>" . $user['email'] . "</td>
                                    <td>" . $user['contact'] . "</td>
                                    <td>" . (strlen($user['address']) > 30 ? 
                                            substr($user['address'], 0, 30) . '...' : 
                                            $user['address']) . "</td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align: center; color: #999;'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>
