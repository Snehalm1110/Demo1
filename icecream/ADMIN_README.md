# iCREAM Admin Dashboard - Setup & Usage Guide

## Overview
This comprehensive admin dashboard provides all the tools needed to manage your ice cream e-commerce store, including products, categories, orders, and users.

## Features

### 1. **Dashboard**
   - Total Users count
   - Total Orders count
   - Total Products count
   - Pending Orders count
   - Recent orders display
   - Quick action buttons

### 2. **Product Management**
   - ✅ Add new products
   - ✅ Edit existing products
   - ✅ Delete products
   - ✅ Upload product images
   - ✅ Set/update prices
   - ✅ Manage product quantities
   - ✅ Categorize products
   - ✅ Set product status (active/inactive)

### 3. **Category Management**
   - ✅ Add new categories
   - ✅ Edit categories
   - ✅ Delete categories
   - ✅ Add category descriptions

### 4. **Order Management**
   - View all orders
   - Update order status (Pending → Confirmed → Shipped → Delivered)
   - Cancel orders
   - View order details (price, quantity, date)

### 5. **User Management**
   - View all registered users
   - View user contact information
   - View user addresses

## Setup Instructions

### Step 1: Import Database Schema
1. Open phpMyAdmin in your browser: `http://localhost/phpmyadmin`
2. Select the `icecream` database
3. Go to the SQL tab
4. Open and execute the `admin_schema.sql` file located in the project root

### Step 2: Create Upload Directory
Create a folder for product images:
```
icecream/
└── uploads/
    └── products/
```

### Step 3: Access Admin Panel

**Admin Login URL:** `http://localhost/icecream/admin_login.php`

**Default Credentials:**
- Email: `admin@icecream.com`
- Password: `admin123`

⚠️ **Important:** Change these credentials immediately after first login for security!

## File Structure

```
icecream/
├── admin_login.php           # Admin login page
├── admin_dashboard.php       # Main dashboard
├── admin_logout.php          # Logout functionality
├── admin_style.css           # Admin styles
├── admin_schema.sql          # Database schema updates
├── manage_products.php       # Product management
├── manage_categories.php     # Category management
├── manage_orders.php         # Order management
├── manage_users.php          # User management
└── uploads/
    └── products/             # Product images storage
```

## Navigation

### Sidebar Menu
- **Dashboard** - Main overview and statistics
- **Products** - Add, edit, delete products
- **Categories** - Manage product categories
- **Orders** - View and update order status
- **Users** - View registered customers

## Detailed Feature Guide

### Adding a Product

1. Click **Products** in the sidebar
2. Click **"Add New Product"** button
3. Fill in the product details:
   - Product Name (required)
   - Category (required)
   - Price in ₹ (required)
   - Quantity Available (required)
   - Description (optional)
   - Product Image (optional)
   - Status (Active/Inactive)
4. Click **"Add Product"** to save

### Adding a Category

1. Click **Categories** in the sidebar
2. Click **"Add New Category"** button
3. Fill in:
   - Category Name (required)
   - Category Description (optional)
4. Click **"Add Category"** to save

### Managing Orders

1. Click **Orders** in the sidebar
2. Select a new status from the dropdown for any order
3. Click the checkmark button to update
4. Status options:
   - Pending (default)
   - Confirmed
   - Shipped
   - Delivered
   - Cancelled

### Viewing Users

1. Click **Users** in the sidebar
2. View all registered customers with their:
   - Name
   - Email
   - Contact number
   - Address

## Database Tables

### admin
```
admin_id (Primary Key)
admin_name
admin_email (Unique)
admin_password (MD5 encrypted)
created_at
```

### category
```
category_id (Primary Key)
category_name (Unique)
category_description
created_at
```

### products
```
product_id (Primary Key)
product_name
category_id (Foreign Key)
price
description
image
quantity_available
status (active/inactive)
created_at
updated_at
```

### user_order (Updated)
```
order_id (Primary Key)
Item_name
Price
Quantity
user_id
order_date
order_status (pending/confirmed/shipped/delivered/cancelled)
```

## Security Notes

1. **Change Default Password**: Update admin credentials in database
   ```sql
   UPDATE admin SET admin_password = MD5('your_new_password') 
   WHERE admin_email = 'admin@icecream.com';
   ```

2. **Always validate user input** on the server side

3. **Use HTTPS** for all admin operations in production

4. **Implement CSRF tokens** for additional security

5. **Set proper file permissions** on the uploads directory

## Troubleshooting

### Images not uploading
- Check if `uploads/products/` directory exists
- Verify directory permissions (755)
- Check file size limits in php.ini

### Database connection error
- Verify MySQL is running
- Check credentials in the PHP files
- Confirm database and tables exist

### Login loop
- Clear browser cookies
- Check session configuration in php.ini
- Verify database connection

## Future Enhancements

- Add analytics and reports
- Product reviews management
- Discount/coupon management
- Email notifications for orders
- Admin user roles and permissions
- Activity logs
- Backup and restore functionality

## Support

For issues or questions, contact the development team.

---

**Last Updated:** February 21, 2026
**Version:** 1.0
