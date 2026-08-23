<?php
echo "PHP Version on Server: " . PHP_VERSION . "\n";
echo "Required for Laravel 11: >= 8.2.0\n";
if (version_compare(PHP_VERSION, '8.2.0', '>=')) {
    echo "✅ PHP version is compatible!\n";
} else {
    echo "❌ PHP version is OUTDATED! Please change your PHP version in cPanel (Select PHP Version / MultiPHP Manager) to PHP 8.2 or 8.3.\n";
}
