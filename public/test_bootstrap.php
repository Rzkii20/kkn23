<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Content-Type: text/plain');

echo "=========================================\n";
echo "🛠️ Laravel HTTP Bootstrapping Diagnostic\n";
echo "=========================================\n\n";

try {
    echo "[1/4] Loading autoload.php...\n";
    require __DIR__.'/../vendor/autoload.php';
    echo "✅ Autoload loaded.\n\n";

    echo "[2/4] Bootstrapping Application (app.php)...\n";
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "✅ Application bootstrapped.\n\n";

    echo "[3/4] Resolving HTTP Kernel...\n";
    // Laravel 11 uses the foundation Application directly, but let's resolve the kernel interface
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "✅ HTTP Kernel resolved.\n\n";

    echo "[4/4] Handling Simulated GET Request to '/'...\n";
    $request = Illuminate\Http\Request::create('/', 'GET');
    
    // Disable exception handling in Laravel to let PHP display the raw error
    if (method_exists($app, 'forget')) {
        // Force display exceptions
    }
    
    $start = microtime(true);
    $response = $kernel->handle($request);
    $end = microtime(true);
    
    echo "✅ REQUEST HANDLED SUCCESSFULY! (Time: " . round(($end - $start), 4) . "s)\n";
    echo "Response Status Code: " . $response->getStatusCode() . "\n\n";
    
    echo "Response Content Preview (First 1000 chars):\n";
    echo "-----------------------------------------\n";
    echo substr($response->getContent(), 0, 1000) . "\n";
    echo "-----------------------------------------\n";
    
    // Terminate request
    $kernel->terminate($request, $response);
    echo "\nRequest terminated successfully.\n";

} catch (\Throwable $e) {
    echo "❌ CRITICAL EXCEPTION THROWN DURING HTTP BOOTSTRAP!\n";
    echo "Class: " . get_class($e) . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Message: " . $e->getMessage() . "\n\n";
    echo "Stack Trace:\n";
    echo $e->getTraceAsString() . "\n";
}
