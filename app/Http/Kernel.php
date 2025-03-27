<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... existing code ...
    
    protected $routeMiddleware = [
        // ... existing middleware ...
        'check.role' => \App\Http\Middleware\CheckRole::class,
    ];
    
    // ... rest of the file ...
}