<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/plain');

echo "=========================================\n";
echo "📂 Laravel Storage Directory Checker & Repairer\n";
echo "=========================================\n\n";

$basePath = realpath(__DIR__ . '/..');
echo "Laravel Base Path: $basePath\n\n";

// List of required directories
$dirs = [
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache'
];

$allOk = true;

foreach ($dirs as $dir) {
    $fullPath = $basePath . '/' . $dir;
    echo "Checking: $dir ... ";
    
    if (!file_exists($fullPath)) {
        echo "❌ MISSING! Attempting to create... ";
        if (mkdir($fullPath, 0777, true)) {
            chmod($fullPath, 0777);
            echo "✅ CREATED (0777)\n";
        } else {
            echo "❌ FAILED TO CREATE!\n";
            $allOk = false;
        }
    } else {
        echo "✅ Exists. Permission: " . substr(sprintf('%o', fileperms($fullPath)), -4);
        
        // Try to make it writable (chmod 777 or 755)
        if (!is_writable($fullPath)) {
            echo " ❌ NOT WRITABLE! Attempting to chmod... ";
            if (chmod($fullPath, 0777)) {
                echo "✅ Fixed (0777)\n";
            } else {
                echo "❌ FAILED to make writable!\n";
                $allOk = false;
            }
        } else {
            echo " (Writable)\n";
        }
    }
}

echo "\n-----------------------------------------\n";
if ($allOk) {
    echo "🎉 ALL STORAGE DIRECTORIES ARE PRESENT AND WRITABLE!\n";
} else {
    echo "⚠️ SOME DIRECTORIES HAVE ISSUES. PLEASE CORRRECT PERMISSIONS IN CPANEL.\n";
}
echo "-----------------------------------------\n";
