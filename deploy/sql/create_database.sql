-- Script inisialisasi database MariaDB untuk Skensa Jaya
-- Jalankan dengan: sudo mariadb < deploy/sql/create_database.sql

CREATE DATABASE IF NOT EXISTS skensa_jaya CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'skensa'@'localhost' IDENTIFIED BY 'skensa123';
GRANT ALL PRIVILEGES ON skensa_jaya.* TO 'skensa'@'localhost';

FLUSH PRIVILEGES;

-- Verifikasi pembuatan database
SHOW DATABASES LIKE 'skensa_jaya';
