<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle($request, Closure $next)
    {
        $startTime = microtime(true);

        // Log setiap request yang masuk
        \Log::info('Incoming request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user' => auth()->user()->name ?? 'guest'
        ]);

        $response = $next($request);

        $duration = microtime(true) - $startTime;

        // Log response
        \Log::info('Request completed', [
            'duration' => round($duration * 1000, 2) . 'ms',
            'status' => $response->status(),
            'url' => $request->fullUrl()
        ]);

        return $response;
    }
}
