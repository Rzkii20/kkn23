<?php

/**
 * Standalone Cache & Compiled Views Cleaner
 * Works independently of Laravel framework bootstrap.
 */

header('Content-Type: text/html; charset=utf-8');
echo "<html><head><title>Pembersih Cache</title></head><body style='font-family: Arial, sans-serif; padding: 30px; background: #f1f5f9;'>";
echo "<div style='background: white; max-width: 600px; margin: 0 auto; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);'>";
echo "<h2 style='color: #0284c7; margin-top: 0;'>🧹 Pembersih Cache & View Laravel</h2>";

$baseDir = dirname(__DIR__);

// 1. Hapus compiled views
$viewDir = $baseDir . '/storage/framework/views';
$viewCount = 0;
if (is_dir($viewDir)) {
    foreach (glob($viewDir . '/*.php') as $file) {
        if (is_file($file)) {
            @unlink($file);
            $viewCount++;
        }
    }
}
echo "<p style='color: #16a34a; font-weight: bold;'>✅ Berhasil menghapus <u>$viewCount</u> file cache tampilan (compiled views)!</p>";

// 2. Hapus bootstrap/cache/*.php (config.php, routes-v7.php, services.php, dll)
$bootDir = $baseDir . '/bootstrap/cache';
$bootCount = 0;
if (is_dir($bootDir)) {
    foreach (glob($bootDir . '/*.php') as $file) {
        if (is_file($file) && basename($file) !== '.gitignore') {
            @unlink($file);
            $bootCount++;
        }
    }
}
echo "<p style='color: #16a34a; font-weight: bold;'>✅ Berhasil menghapus <u>$bootCount</u> file cache bootstrap (config & route cache)!</p>";

echo "<div style='margin-top: 25px; padding-top: 15px; border-top: 1px solid #e2e8f0;'>";
echo "<a href='/' style='display: inline-block; background: #0284c7; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold;'>👉 Buka Halaman Utama Website</a>";
echo "</div>";

echo "</div></body></html>";
