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
$product_id = isset($_GET['id']) ? $_GET['id'] : '';
$message = '';
$error = '';

// Handle delete
if (isset($_GET['delete'])) {
    $delete_id = mysqli_real_escape_string($con, $_GET['delete']);
    
    // Get product image to delete
    $img_result = mysqli_query($con, "SELECT image FROM products WHERE product_id = '$delete_id'");
    $img_row = mysqli_fetch_assoc($img_result);
    
    if ($img_row && $img_row['image']) {
        $img_path = "uploads/products/" . $img_row['image'];
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }
    
    $sql = "DELETE FROM products WHERE product_id = '$delete_id'";
    if (mysqli_query($con, $sql)) {
        $message = "Product deleted successfully!";
    } else {
        $error = "Error deleting product: " . mysqli_error($con);
    }
}

// Handle add/update product
if (isset($_POST['save_product'])) {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    // Handle image upload
    $image_name = '';
    if ($_FILES['image']['size'] > 0) {
        $target_dir = "uploads/products/";
        
        // Create directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        $image_name = basename($_FILES['image']['name']);
        $target_file = $target_dir . time() . "_" . $image_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_name = time() . "_" . $image_name;
        } else {
            $error = "Error uploading image.";
        }
    }
    
    if (!$error) {
        if ($_POST['action'] == 'add') {
            $sql = "INSERT INTO products (product_name, category_id, price, description, quantity_available, image, status) 
                    VALUES ('$product_name', '$category_id', '$price', '$description', '$quantity', '$image_name', '$status')";
            $success_msg = "Product added successfully!";
        } else {
            $pid = mysqli_real_escape_string($con, $_POST['product_id']);
            
            // If new image is uploaded, use it; otherwise keep the old one
            if ($image_name) {
                $update_img = ", image = '$image_name'";
            } else {
                $update_img = "";
            }
            
            $sql = "UPDATE products SET product_name = '$product_name', category_id = '$category_id', 
                    price = '$price', description = '$description', quantity_available = '$quantity', 
                    status = '$status' $update_img WHERE product_id = '$pid'";
            $success_msg = "Product updated successfully!";
        }
        
        if (mysqli_query($con, $sql)) {
            $message = $success_msg;
            $action = 'list';
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}

// Get categories
$categories = mysqli_query($con, "SELECT * FROM category");

// Get products for display
$products = mysqli_query($con, "SELECT p.*, c.category_name FROM products p LEFT JOIN category c ON p.category_id = c.category_id ORDER BY p.product_id DESC");

// Get product for edit
$edit_product = null;
if ($action == 'edit' && $product_id) {
    $product_id = mysqli_real_escape_string($con, $product_id);
    $result = mysqli_query($con, "SELECT * FROM products WHERE product_id = '$product_id'");
    $edit_product = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - iCREAM Admin</title>
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
            <a href="manage_products.php" class="nav-item active">
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
                <h1><?php echo ($action == 'edit') ? 'Edit Product' : 'Manage Products'; ?></h1>
                <p>Manage your ice cream products</p>
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
        
        <!-- Add/Edit Product Form -->
        <?php if ($action == 'add' || $action == 'edit'): ?>
            <section class="form-section">
                <form method="POST" enctype="multipart/form-data" class="product-form">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <?php if ($action == 'edit'): ?>
                        <input type="hidden" name="product_id" value="<?php echo $edit_product['product_id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Product Name *</label>
                            <input type="text" name="product_name" required 
                                   value="<?php echo $edit_product['product_name'] ?? ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Category *</label>
                            <select name="category_id" required>
                                <option value="">Select Category</option>
                                <?php
                                mysqli_data_seek($categories, 0);
                                while ($cat = mysqli_fetch_assoc($categories)) {
                                    $selected = ($edit_product && $edit_product['category_id'] == $cat['category_id']) ? 'selected' : '';
                                    echo "<option value='" . $cat['category_id'] . "' $selected>" . $cat['category_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Price (₹) *</label>
                            <input type="number" name="price" step="0.01" required 
                                   value="<?php echo $edit_product['price'] ?? ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Quantity Available *</label>
                            <input type="number" name="quantity" required 
                                   value="<?php echo $edit_product['quantity_available'] ?? ''; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="4"><?php echo $edit_product['description'] ?? ''; ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" name="image" accept="image/*">
                            <?php if ($edit_product && $edit_product['image']): ?>
                                <p class="file-help">Current image: <?php echo $edit_product['image']; ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Status *</label>
                            <select name="status" required>
                                <option value="active" <?php echo ($edit_product['status'] ?? 'active') == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo ($edit_product['status'] ?? '') == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" name="save_product" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php echo ($action == 'edit') ? 'Update' : 'Add'; ?> Product
                        </button>
                        <a href="manage_products.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </section>
        <?php endif; ?>
        
        <!-- Products List -->
        <?php if ($action == 'list'): ?>
            <section class="content-section">
                <div class="section-header">
                    <h2>All Products</h2>
                    <a href="manage_products.php?action=add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Product
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price (₹)</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($products) > 0) {
                                while ($product = mysqli_fetch_assoc($products)) {
                                    $status_class = $product['status'] == 'active' ? 'active' : 'inactive';
                                    echo "
                                    <tr>
                                        <td>#" . $product['product_id'] . "</td>
                                        <td>" . $product['product_name'] . "</td>
                                        <td>" . ($product['category_name'] ?? 'Uncategorized') . "</td>
                                        <td>₹" . $product['price'] . "</td>
                                        <td>" . $product['quantity_available'] . "</td>
                                        <td><span class='status-badge " . $status_class . "'>" . ucfirst($product['status']) . "</span></td>
                                        <td>
                                            <a href='manage_products.php?action=edit&id=" . $product['product_id'] . "' class='action-btn edit' title='Edit'>
                                                <i class='fas fa-edit'></i>
                                            </a>
                                            <a href='manage_products.php?delete=" . $product['product_id'] . "' class='action-btn delete' title='Delete' onclick='return confirm(\"Are you sure?\")'>
                                                <i class='fas fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='7' style='text-align: center; color: #999;'>No products found</td></tr>";
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
