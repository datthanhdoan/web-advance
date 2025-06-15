<?php

echo "Manual Migration Script\n";
echo "======================\n\n";

try {
    // Database connection
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS mini_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Database 'mini_blog' ready\n";
    
    // Connect to specific database
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=mini_blog', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create migrations table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations (
            id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            migration varchar(255) NOT NULL,
            batch int NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Migrations table ready\n";
    
    // Drop existing tables if they exist
    $tables = ['post_tag', 'posts', 'tags', 'categories', 'users', 'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs', 'sessions'];
    foreach ($tables as $table) {
        $pdo->exec("DROP TABLE IF EXISTS `$table`");
    }
    echo "✅ Cleaned existing tables\n";
    
    // Create users table
    $pdo->exec("
        CREATE TABLE users (
            id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL UNIQUE,
            email_verified_at timestamp NULL,
            password varchar(255) NOT NULL,
            remember_token varchar(100) NULL,
            created_at timestamp NULL,
            updated_at timestamp NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Users table created\n";
    
    // Create cache table
    $pdo->exec("
        CREATE TABLE cache (
            `key` varchar(255) NOT NULL PRIMARY KEY,
            value mediumtext NOT NULL,
            expiration int NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    $pdo->exec("
        CREATE TABLE cache_locks (
            `key` varchar(255) NOT NULL PRIMARY KEY,
            owner varchar(255) NOT NULL,
            expiration int NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Cache tables created\n";
    
    // Create jobs table
    $pdo->exec("
        CREATE TABLE jobs (
            id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            queue varchar(255) NOT NULL,
            payload longtext NOT NULL,
            attempts tinyint unsigned NOT NULL,
            reserved_at int unsigned NULL,
            available_at int unsigned NOT NULL,
            created_at int unsigned NOT NULL,
            INDEX jobs_queue_index (queue)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    $pdo->exec("
        CREATE TABLE job_batches (
            id varchar(255) NOT NULL PRIMARY KEY,
            name varchar(255) NOT NULL,
            total_jobs int NOT NULL,
            pending_jobs int NOT NULL,
            failed_jobs int NOT NULL,
            failed_job_ids longtext NOT NULL,
            options mediumtext NULL,
            cancelled_at int NULL,
            created_at int NOT NULL,
            finished_at int NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    $pdo->exec("
        CREATE TABLE failed_jobs (
            id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            uuid varchar(255) NOT NULL UNIQUE,
            connection text NOT NULL,
            queue text NOT NULL,
            payload longtext NOT NULL,
            exception longtext NOT NULL,
            failed_at timestamp DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Job tables created\n";
    
    // Create sessions table
    $pdo->exec("
        CREATE TABLE sessions (
            id varchar(255) NOT NULL PRIMARY KEY,
            user_id bigint unsigned NULL,
            ip_address varchar(45) NULL,
            user_agent text NULL,
            payload longtext NOT NULL,
            last_activity int NOT NULL,
            INDEX sessions_user_id_index (user_id),
            INDEX sessions_last_activity_index (last_activity)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Sessions table created\n";
    
    // Create categories table
    $pdo->exec("
        CREATE TABLE categories (
            id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name varchar(255) NOT NULL,
            slug varchar(255) NOT NULL UNIQUE,
            description text NULL,
            color varchar(7) NOT NULL DEFAULT '#6B7280',
            created_at timestamp NULL,
            updated_at timestamp NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Categories table created\n";
    
    // Create tags table
    $pdo->exec("
        CREATE TABLE tags (
            id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name varchar(255) NOT NULL,
            slug varchar(255) NOT NULL UNIQUE,
            color varchar(7) NOT NULL DEFAULT '#10B981',
            created_at timestamp NULL,
            updated_at timestamp NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Tags table created\n";
    
    // Create posts table
    $pdo->exec("
        CREATE TABLE posts (
            id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            title varchar(255) NOT NULL,
            slug varchar(255) NOT NULL UNIQUE,
            excerpt text NULL,
            content longtext NOT NULL,
            featured_image varchar(255) NULL,
            status enum('draft','published') NOT NULL DEFAULT 'draft',
            published_at timestamp NULL,
            read_time int NOT NULL DEFAULT 0,
            views int NOT NULL DEFAULT 0,
            category_id bigint unsigned NULL,
            created_at timestamp NULL,
            updated_at timestamp NULL,
            INDEX posts_status_index (status),
            INDEX posts_published_at_index (published_at),
            INDEX posts_category_id_index (category_id),
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Posts table created\n";
    
    // Create post_tag pivot table
    $pdo->exec("
        CREATE TABLE post_tag (
            id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            post_id bigint unsigned NOT NULL,
            tag_id bigint unsigned NOT NULL,
            created_at timestamp NULL,
            updated_at timestamp NULL,
            UNIQUE KEY post_tag_post_id_tag_id_unique (post_id, tag_id),
            FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
            FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Post_tag table created\n";
    
    // Clear migrations table and add our migrations
    $pdo->exec("DELETE FROM migrations");
    
    $migrations = [
        '0001_01_01_000000_create_users_table',
        '0001_01_01_000001_create_cache_table', 
        '0001_01_01_000002_create_jobs_table',
        '2024_01_01_000001_create_categories_table',
        '2024_01_01_000002_create_tags_table',
        '2024_01_01_000003_create_posts_table',
        '2024_01_01_000004_create_post_tag_table'
    ];
    
    foreach ($migrations as $i => $migration) {
        $pdo->exec("INSERT INTO migrations (migration, batch) VALUES ('$migration', 1)");
    }
    echo "✅ Migration records added\n";
    
    echo "\n🎉 All tables created successfully!\n";
    echo "You can now run: php artisan db:seed\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Please make sure XAMPP MySQL is running\n";
}
?> 