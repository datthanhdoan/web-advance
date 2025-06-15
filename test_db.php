<?php

echo "Testing database connection...\n";

try {
    // Test MySQL connection
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    echo "✅ MySQL connection successful\n";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'mini_blog'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Database 'mini_blog' exists\n";
    } else {
        echo "❌ Database 'mini_blog' does not exist\n";
        echo "Creating database...\n";
        $pdo->exec("CREATE DATABASE mini_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "✅ Database 'mini_blog' created\n";
    }
    
    // Test connection to specific database
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=mini_blog', 'root', '');
    echo "✅ Connection to 'mini_blog' database successful\n";
    
    // Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "ℹ️  No tables found in database\n";
    } else {
        echo "📋 Tables found: " . implode(', ', $tables) . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "Please make sure XAMPP MySQL is running\n";
}

echo "\nDone!\n";
?> 