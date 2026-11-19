<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureStaffRole
{
    public function handle(Request $request, Closure $next): Response
    {
       
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized Access. Para lamang sa awtorisadong opisyal ng barangay.');
        }

        return $next($request);
    }
}