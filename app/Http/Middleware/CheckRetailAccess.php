<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRetailAccess
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('type') === null && session('type') !== 'ecer') {
            return redirect('/kasir/grosir');
        }

        return $next($request);
    }
}
