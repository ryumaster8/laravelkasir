<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array(session('role'), $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
