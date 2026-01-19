-- Create database
CREATE DATABASE IF NOT EXISTS yii_users;
USE yii_users;

-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert default admin user
-- Password: admin123 (hashed with MD5 for simplicity)
INSERT INTO `users` (`username`, `password`, `email`, `first_name`, `last_name`, `status`, `created_at`, `updated_at`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'admin@example.com', 'Admin', 'User', 1, NOW(), NOW()),
('demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', 'Demo', 'User', 1, NOW(), NOW());
