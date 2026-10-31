-- Admin Users Table
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL UNIQUE,
  `admin_password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Categories Table
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL UNIQUE,
  `category_description` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Products Table
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) NOT NULL,
  `category_id` int(11),
  `price` decimal(10, 2) NOT NULL,
  `description` text,
  `image` varchar(255),
  `quantity_available` int(11) DEFAULT 0,
  `status` enum('active', 'inactive') DEFAULT 'active',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Updated user_order Table with dynamic tracking
ALTER TABLE `user_order` ADD COLUMN `user_id` int(11);
ALTER TABLE `user_order` ADD COLUMN `order_date` timestamp DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `user_order` ADD COLUMN `order_status` enum('pending', 'confirmed', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending';

-- Ensure proper indexes
ALTER TABLE `user_order` ADD INDEX `idx_user_id` (`user_id`);
ALTER TABLE `user_order` ADD INDEX `idx_status` (`order_status`);
ALTER TABLE `user_order` ADD INDEX `idx_date` (`order_date`);

-- Insert sample categories
INSERT IGNORE INTO `category` (`category_name`, `category_description`) VALUES
('Ice Cream', 'Premium ice cream flavors'),
('Milkshakes', 'Delicious milkshakes and cold beverages'),
('Falooda', 'Traditional falooda and frozen desserts'),
('Cones & Cups', 'Ice cream cones and cups');

-- Default admin user (email: admin@icecream.com, password: admin123)
INSERT IGNORE INTO `admin` (`admin_name`, `admin_email`, `admin_password`) VALUES
('Admin', 'admin@icecream.com', MD5('admin123'));

-- Insert sample products
INSERT IGNORE INTO `products` (`product_name`, `category_id`, `price`, `description`, `quantity_available`, `status`) VALUES
('Vanilla Ice-Cream', 1, 70.00, 'Classic vanilla ice cream', 50, 'active'),
('Mango Ice Cream', 1, 100.00, 'Fresh mango ice cream', 45, 'active'),
('Chocolate Ice Cream', 1, 120.00, 'Rich chocolate flavor', 40, 'active'),
('Mix Ice-Cream', 1, 80.00, 'Mixed flavor ice cream', 35, 'active'),
('Strawberry Milkshake', 2, 110.00, 'Tasty strawberry shake', 30, 'active'),
('Falooda', 3, 120.00, 'Traditional falooda', 25, 'active');
