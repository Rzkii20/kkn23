<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Content-Type: text/plain');

$diagnosticsStartTime = microtime(true);

echo "=========================================\n";
echo "🔍 Laravel Ultimate Step-by-Step Tracer\n";
echo "=========================================\n\n";

register_shutdown_function(function() use ($diagnosticsStartTime) {
    $elapsed = microtime(true) - $diagnosticsStartTime;
    echo "\n\n=========================================\n";
    echo "⏱️ Execution ended after " . round($elapsed, 4) . " seconds.\n";
    
    $error = error_get_last();
    if ($error !== null) {
        echo "❌ FATAL ERROR CAUGHT IN SHUTDOWN:\n";
        echo "Type: " . $error['type'] . "\n";
        echo "Message: " . $error['message'] . "\n";
        echo "File: " . $error['file'] . "\n";
        echo "Line: " . $error['line'] . "\n";
    } else {
        echo "ℹ️ Process terminated cleanly (or killed externally) with no uncaught errors.\n";
    }
    echo "=========================================\n";
});

try {
    echo "[Step 1] Loading vendor/autoload.php...\n";
    require __DIR__.'/../vendor/autoload.php';
    echo "✅ Autoload loaded.\n\n";

    echo "[Step 2] Creating Application instance...\n";
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "✅ Application instance created.\n\n";

    echo "[Step 3] Creating HTTP Kernel instance...\n";
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "✅ HTTP Kernel instance created.\n\n";

    echo "[Step 4] Running Kernel Bootstrappers...\n";
    $reflector = new ReflectionClass(get_class($kernel));
    $bootstrapMethod = $reflector->getMethod('bootstrap');
    $bootstrapMethod->setAccessible(true);
    
    $startBoot = microtime(true);
    $bootstrapMethod->invoke($kernel);
    $endBoot = microtime(true);
    echo "✅ Kernel Bootstrappers finished in " . round(($endBoot - $startBoot), 4) . "s.\n\n";

    echo "[Step 5] Simulating Request object for '/up'...\n";
    $request = Illuminate\Http\Request::create('/up', 'GET');
    $app->instance('request', $request);
    echo "✅ Request object bound.\n\n";

    echo "[Step 6] Running Global Middleware one-by-one with Config loaded...\n";
    if ($reflector->hasProperty('middleware')) {
        $property = $reflector->getProperty('middleware');
        $property->setAccessible(true);
        $middlewareList = $property->getValue($kernel);
        
        foreach ($middlewareList as $index => $mw) {
            echo "  - Running [$index] $mw ... ";
            $startMw = microtime(true);
            try {
                $mwInstance = $app->make($mw);
                $response = $mwInstance->handle($request, function($req) {
                    return new \Illuminate\Http\Response("Pipeline Next");
                });
                $endMw = microtime(true);
                echo "✅ Success (" . round(($endMw - $startMw), 4) . "s)\n";
            } catch (\Throwable $mwErr) {
                echo "❌ FAILED with exception: " . $mwErr->getMessage() . " in " . $mwErr->getFile() . " on line " . $mwErr->getLine() . "\n";
            }
        }
    } else {
        echo "⚠️ No global middleware property found on kernel.\n";
    }
    echo "✅ Global middleware testing completed.\n\n";

    echo "[Step 7] Dispatching Request to Router...\n";
    $router = $app->make('router');
    
    echo "  - Finding matching route for '/up'...\n";
    $route = $router->getRoutes()->match($request);
    echo "  ✅ Route found! Name: '" . $route->getName() . "' | Action: " . json_encode($route->getAction()) . "\n\n";

    echo "[Step 8] Running Route Middleware...\n";
    $routeMiddleware = $router->gatherRouteMiddleware($route);
    echo "  Gathered Route Middleware count: " . count($routeMiddleware) . "\n";
    foreach ($routeMiddleware as $rmw) {
        echo "    - $rmw\n";
    }
    echo "  - Executing route pipeline...\n";
    
    $startPipeline = microtime(true);
    $response = $router->respondToRoute($route, $request);
    $endPipeline = microtime(true);
    
    echo "✅ Route pipeline finished in " . round(($endPipeline - $startPipeline), 4) . "s.\n";
    echo "Response Status: " . $response->getStatusCode() . "\n";
    echo "Response Content Preview:\n";
    echo "-----------------------------------------\n";
    echo substr($response->getContent(), 0, 300) . "\n";
    echo "-----------------------------------------\n";

} catch (\Throwable $e) {
    echo "\n❌ CRITICAL EXCEPTION THROWN AT STEP LEVEL:\n";
    echo "Class: " . get_class($e) . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Message: " . $e->getMessage() . "\n\n";
    echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
}
