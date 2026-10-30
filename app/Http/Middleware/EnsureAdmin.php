<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya user dengan role admin yang boleh lewat, selain itu 403
        if ($request->user()?->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
