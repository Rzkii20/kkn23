<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Content-Type: text/plain');

echo "=========================================\n";
echo "🛠️ Laravel HTTP Bootstrapping Diagnostic\n";
echo "=========================================\n\n";

// Register shutdown function to catch fatal errors
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null) {
        echo "\n\n❌ FATAL ERROR CAUGHT IN SHUTDOWN FUNCTION:\n";
        echo "Type: " . $error['type'] . "\n";
        echo "Message: " . $error['message'] . "\n";
        echo "File: " . $error['file'] . "\n";
        echo "Line: " . $error['line'] . "\n";
    } else {
        echo "\n\n[Shutdown] Script execution stopped. If the output above is incomplete, the process may have been killed by the server.\n";
    }
});

try {
    echo "[1/4] Loading autoload.php...\n";
    require __DIR__.'/../vendor/autoload.php';
    echo "✅ Autoload loaded.\n\n";

    echo "[2/4] Bootstrapping Application (app.php)...\n";
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "✅ Application bootstrapped.\n\n";

    // Register event listeners for diagnostics
    $events = $app->make('events');
    echo "Registering event listeners...\n";
    
    $events->listen(\Illuminate\Database\Events\QueryExecuted::class, function ($event) {
        echo "  🔍 [SQL] " . $event->sql . " (Time: " . $event->time . "ms)\n";
    });
    
    $events->listen(\Illuminate\Routing\Events\RouteMatched::class, function ($event) {
        echo "  🎯 [Route] Matched: '" . $event->route->getName() . "' (URI: " . $event->route->uri() . ")\n";
    });
    echo "✅ Event listeners registered.\n\n";

    echo "[3/4] Resolving HTTP Kernel...\n";
    // Laravel 11 uses the foundation Application directly, but let's resolve the kernel interface
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "✅ HTTP Kernel resolved.\n\n";

    // Reflect and print global middleware
    try {
        $reflector = new ReflectionClass(get_class($kernel));
        if ($reflector->hasProperty('middleware')) {
            $property = $reflector->getProperty('middleware');
            $property->setAccessible(true);
            $middleware = $property->getValue($kernel);
            echo "Global Middleware found: " . count($middleware) . "\n";
            foreach ($middleware as $index => $mw) {
                echo "  - [" . $index . "] " . $mw . "\n";
            }
        } else {
            echo "No global middleware property found on kernel class.\n";
        }
    } catch (\Exception $refErr) {
        echo "Reflection failed: " . $refErr->getMessage() . "\n";
    }
    echo "\n";

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
