<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/plain');

echo "=========================================\n";
echo "🚀 Laravel Database Connection Tester\n";
echo "=========================================\n\n";

// Load .env manual parser
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    die("Error: .env file not found at: " . realpath($envFile) . "\n");
}

echo "Reading .env file...\n";
$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
        list($key, $value) = explode('=', $line, 2);
        $value = trim($value, " '\"");
        $_ENV[$key] = $value;
    }
}

$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$port = $_ENV['DB_PORT'] ?? '3306';
$db   = $_ENV['DB_DATABASE'] ?? '';
$user = $_ENV['DB_USERNAME'] ?? '';
$pass = $_ENV['DB_PASSWORD'] ?? '';

echo "Database Config from .env:\n";
echo "- DB_HOST: $host\n";
echo "- DB_PORT: $port\n";
echo "- DB_DATABASE: $db\n";
echo "- DB_USERNAME: $user\n";
echo "- DB_PASSWORD: " . (empty($pass) ? "[empty]" : "[hidden (length: " . strlen($pass) . ")]") . "\n\n";

echo "Attempting to connect via PDO (Timeout: 5s)...\n";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_TIMEOUT            => 5,
    ];
    
    $start = microtime(true);
    $pdo = new PDO($dsn, $user, $pass, $options);
    $end = microtime(true);
    
    echo "✅ CONNECTION SUCCESSFUL! (Time: " . round(($end - $start), 4) . "s)\n\n";
    
    // Check if we can query tables
    echo "Querying tables...\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "The database is currently empty (No tables found).\n";
    } else {
        echo "Found " . count($tables) . " tables:\n";
        foreach ($tables as $table) {
            echo "  - $table\n";
        }
    }

    echo "\nQuerying active MySQL processes (SHOW FULL PROCESSLIST)...\n";
    $stmt = $pdo->query("SHOW FULL PROCESSLIST");
    $processes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Found " . count($processes) . " active processes:\n";
    foreach ($processes as $proc) {
        echo "  - ID: " . $proc['Id'] . " | User: " . $proc['User'] . " | Host: " . $proc['Host'] . " | Command: " . $proc['Command'] . " | Time: " . $proc['Time'] . "s | State: " . $proc['State'] . " | Info: " . $proc['Info'] . "\n";
    }
    
} catch (\PDOException $e) {
    echo "❌ CONNECTION FAILED!\n";
    echo "Error Code: " . $e->getCode() . "\n";
    echo "Error Message: " . $e->getMessage() . "\n";
}
