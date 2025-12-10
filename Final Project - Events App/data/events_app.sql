-- Create database 
CREATE DATABASE event_planner
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE event_planner;

-- Admins table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Single admin user:
-- username: admin
-- password: finalproject
INSERT INTO admins (username, password_hash) VALUES
('admin', '$2y$10$Fsvfburg2RL/LVPczaH1Deb6auT8Z0fS6jLsHFOnh92zejQKwEgKC');

-- Events table
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    event_date DATETIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

-- Registrations table
CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY Key,
    event_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    registered_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    -- No foreign key constraint required for this project
);