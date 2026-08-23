<?php

/**
 * Laravel cPanel Deployment Helper Script
 * This script runs migrations, seeds the database, links storage, and clears cache via browser.
 */

// Define start time
define('LARAVEL_START', microtime(true));

// Check if vendor/autoload.php exists
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Error: vendor/autoload.php not found. Please run "composer install" on your server or upload the vendor folder.');
}

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Alias Artisan
$artisan = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<html><head><title>Laravel cPanel Deployment Helper</title></head><body style='font-family: monospace; padding: 20px; background: #f8fafc; color: #1e293b;'>";
echo "<h1 style='color: #0b4777; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;'>🚀 Laravel cPanel Deployment Helper</h1>";

// === STORAGE LINK ONLY MODE ===
// Akses: https://sebonglagoi.com/deploy.php?action=storage
if (isset($_GET['action']) && $_GET['action'] === 'storage') {
    echo "<pre style='background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;'>";
    echo "<b>🔗 Creating Storage Symlink...</b>\n";
    $kernel->call('storage:link', ['--force' => true]);
    echo $kernel->output();
    echo "<span style='color: green; font-weight: bold;'>✅ Storage symlink berhasil dibuat!</span>\n";
    echo "Gambar sekarang bisa diakses di: <a href='/storage'>/storage</a>\n";
    echo "</pre></body></html>";
    exit;
}

// === CONFIG CACHE ONLY MODE ===
// Akses: https://sebonglagoi.com/deploy.php?action=cache
if (isset($_GET['action']) && $_GET['action'] === 'cache') {
    echo "<pre style='background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;'>";
    echo "<b>⚡ Clearing & Rebuilding Cache...</b>\n";
    $kernel->call('config:clear'); echo $kernel->output();
    $kernel->call('config:cache'); echo $kernel->output();
    $kernel->call('route:clear');  echo $kernel->output();
    $kernel->call('view:clear');   echo $kernel->output();
    echo "<span style='color: green; font-weight: bold;'>✅ Cache berhasil di-refresh!</span>\n";
    echo "</pre></body></html>";
    exit;
}

echo "<pre style='background: #ffffff; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;'>";

try {
    // 1. Run Migrations
    echo "<b>[1/4] Running Database Migrations...</b>\n";
    $kernel->call('migrate', ['--force' => true]);
    echo $kernel->output();
    echo "\n";

    // 2. Run Database Seeding
    echo "<b>[2/4] Running Database Seeder...</b>\n";
    $kernel->call('db:seed', ['--force' => true]);
    echo $kernel->output();
    echo "\n";

    // 3. Create Storage Symlink
    echo "<b>[3/4] Creating Storage Symlink...</b>\n";
    $kernel->call('storage:link', ['--force' => true]);
    echo $kernel->output();
    echo "\n";

    // 4. Cache Config
    echo "<b>[4/4] Optimizing Configuration Cache...</b>\n";
    $kernel->call('config:cache');
    echo $kernel->output();
    $kernel->call('route:cache');
    echo $kernel->output();
    echo "\n";

    echo "<span style='color: green; font-weight: bold;'>🎉 ALL DEPLOYMENT COMMANDS EXECUTED SUCCESSFULLY!</span>\n";
    echo "You can now access your website at <a href='/'>sebonglagoi.com</a>.\n";
    echo "<span style='color: red; font-weight: bold;'>⚠️ IMPORTANT: Please delete or rename this file (public/deploy.php) after deployment for security!</span>";

} catch (\Exception $e) {
    echo "<span style='color: red; font-weight: bold;'>❌ ERROR OCCURRED:</span>\n";
    echo $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

echo "</pre></body></html>";
