<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRetailType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get 'type' parameter from route or default to 'ecer'
        $type = $request->route('type', 'ecer');

        // Validate the type parameter
        if (!in_array($type, ['ecer', 'grosir'])) {
            // Redirect to the default route if the type is invalid
            return redirect()->route('kasir.index')->with('error', 'Invalid retail type.');
        }

        // Store the validated type in the session
        session(['type' => $type]);

        // Proceed with the request
        return $next($request);
    }
}
