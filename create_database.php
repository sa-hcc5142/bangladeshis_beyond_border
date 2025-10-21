<?php


$host = '127.0.0.1';
$username = 'root';
$password = ''; // Update if you have a password
$database = 'bangladeshis_beyond_border';

try {
    // Connect to MySQL server
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $conn->exec($sql);
    
    echo "✅ Database '$database' created successfully!\n";
    echo "📝 Database config:\n";
    echo "   - Host: $host\n";
    echo "   - Database: $database\n";
    echo "   - Username: $username\n";
    echo "   - Password: " . (empty($password) ? '(empty)' : '(set)') . "\n";
    echo "\n";
    echo "🚀 Next step: Run migrations\n";
    echo "   php artisan migrate\n";
    
} catch(PDOException $e) {
    echo "❌ Error creating database: " . $e->getMessage() . "\n";
    echo "\n";
    echo "🔧 Troubleshooting:\n";
    echo "   1. Make sure XAMPP MySQL is running\n";
    echo "   2. Open XAMPP Control Panel and start MySQL\n";
    echo "   3. Check MySQL username/password in .env file\n";
    echo "   4. Or create database manually in phpMyAdmin:\n";
    echo "      - Open: http://localhost/phpmyadmin\n";
    echo "      - Click 'New' to create database\n";
    echo "      - Database name: bangladeshis_beyond_border\n";
    echo "      - Collation: utf8mb4_unicode_ci\n";
}
