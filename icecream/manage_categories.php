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

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$category_id = isset($_GET['id']) ? $_GET['id'] : '';
$message = '';
$error = '';

// Handle delete
if (isset($_GET['delete'])) {
    $delete_id = mysqli_real_escape_string($con, $_GET['delete']);
    
    // Check if category has products
    $check = mysqli_query($con, "SELECT COUNT(*) as count FROM products WHERE category_id = '$delete_id'");
    $result = mysqli_fetch_assoc($check);
    
    if ($result['count'] > 0) {
        $error = "Cannot delete category with existing products. Please delete or reassign products first.";
    } else {
        $sql = "DELETE FROM category WHERE category_id = '$delete_id'";
        if (mysqli_query($con, $sql)) {
            $message = "Category deleted successfully!";
        } else {
            $error = "Error deleting category: " . mysqli_error($con);
        }
    }
}

// Handle add/update category
if (isset($_POST['save_category'])) {
    $category_name = mysqli_real_escape_string($con, $_POST['category_name']);
    $category_description = mysqli_real_escape_string($con, $_POST['category_description']);
    
    if (!$category_name) {
        $error = "Category name is required.";
    } else if ($_POST['action'] == 'add') {
        $sql = "INSERT INTO category (category_name, category_description) 
                VALUES ('$category_name', '$category_description')";
        $success_msg = "Category added successfully!";
        
        if (mysqli_query($con, $sql)) {
            $message = $success_msg;
            $action = 'list';
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    } else {
        $cid = mysqli_real_escape_string($con, $_POST['category_id']);
        $sql = "UPDATE category SET category_name = '$category_name', category_description = '$category_description' 
                WHERE category_id = '$cid'";
        $success_msg = "Category updated successfully!";
        
        if (mysqli_query($con, $sql)) {
            $message = $success_msg;
            $action = 'list';
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}

// Get categories
$categories = mysqli_query($con, "SELECT * FROM category ORDER BY category_id DESC");

// Get category for edit
$edit_category = null;
if ($action == 'edit' && $category_id) {
    $category_id = mysqli_real_escape_string($con, $category_id);
    $result = mysqli_query($con, "SELECT * FROM category WHERE category_id = '$category_id'");
    $edit_category = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - iCREAM Admin</title>
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
            <a href="manage_categories.php" class="nav-item active">
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
                <h1><?php echo ($action == 'edit') ? 'Edit Category' : 'Manage Categories'; ?></h1>
                <p>Manage product categories</p>
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
        
        <!-- Add/Edit Category Form -->
        <?php if ($action == 'add' || $action == 'edit'): ?>
            <section class="form-section">
                <form method="POST" class="category-form">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <?php if ($action == 'edit'): ?>
                        <input type="hidden" name="category_id" value="<?php echo $edit_category['category_id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label>Category Name *</label>
                        <input type="text" name="category_name" required 
                               placeholder="Enter category name"
                               value="<?php echo $edit_category['category_name'] ?? ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Category Description</label>
                        <textarea name="category_description" rows="5" 
                                  placeholder="Enter category description"><?php echo $edit_category['category_description'] ?? ''; ?></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" name="save_category" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php echo ($action == 'edit') ? 'Update' : 'Add'; ?> Category
                        </button>
                        <a href="manage_categories.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </section>
        <?php endif; ?>
        
        <!-- Categories List -->
        <?php if ($action == 'list'): ?>
            <section class="content-section">
                <div class="section-header">
                    <h2>All Categories</h2>
                    <a href="manage_categories.php?action=add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Category
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($categories) > 0) {
                                while ($category = mysqli_fetch_assoc($categories)) {
                                    echo "
                                    <tr>
                                        <td>#" . $category['category_id'] . "</td>
                                        <td><strong>" . $category['category_name'] . "</strong></td>
                                        <td>" . (strlen($category['category_description']) > 50 ? 
                                                substr($category['category_description'], 0, 50) . '...' : 
                                                $category['category_description']) . "</td>
                                        <td>" . date('M d, Y', strtotime($category['created_at'])) . "</td>
                                        <td>
                                            <a href='manage_categories.php?action=edit&id=" . $category['category_id'] . "' class='action-btn edit' title='Edit'>
                                                <i class='fas fa-edit'></i>
                                            </a>
                                            <a href='manage_categories.php?delete=" . $category['category_id'] . "' class='action-btn delete' title='Delete' onclick='return confirm(\"Are you sure?\")'>
                                                <i class='fas fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='5' style='text-align: center; color: #999;'>No categories found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php endif; ?>
    </div>
</body>
</html>
