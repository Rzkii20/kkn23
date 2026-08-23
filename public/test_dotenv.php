<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/plain');

echo "=========================================\n";
echo "🔍 Dotenv Syntax Validator\n";
echo "=========================================\n\n";

$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die("Error: .env file not found at: " . realpath($envPath) . "\n");
}

echo "Reading .env file...\n";
$content = file_get_contents($envPath);
echo "File size: " . strlen($content) . " bytes\n\n";

// Show lines without showing sensitive passwords
echo "Checking line formatting (masking passwords):\n";
$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $index => $line) {
    $lineNumber = $index + 1;
    // Mask sensitive fields
    if (preg_match('/^(DB_PASSWORD|APP_KEY|MAIL_PASSWORD)=/i', $line)) {
        list($key, $val) = explode('=', $line, 2);
        echo "Line $lineNumber: $key=[HIDDEN]\n";
    } else {
        echo "Line $lineNumber: $line\n";
    }
}
echo "\n";

echo "Attempting to parse with Dotenv library...\n";
require __DIR__ . '/../vendor/autoload.php';

try {
    // Attempt standard Laravel 11 Dotenv loading
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(dirname($envPath));
    $dotenv->load();
    echo "\n✅ SUCCESS! Dotenv loaded the .env file successfully without any syntax errors!\n";
} catch (\Dotenv\Exception\InvalidFileException $e) {
    echo "\n❌ SYNTAX ERROR DETECTED IN YOUR .env FILE!\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "Please fix the formatting of that line in your cPanel File Manager.\n";
} catch (\Throwable $e) {
    echo "\n❌ OTHER PARSING ERROR: " . $e->getMessage() . "\n";
}
