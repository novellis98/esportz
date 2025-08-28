<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role != $role) {
            return redirect('/');  // Se il ruolo non corrisponde, reindirizza alla homepage
        }

        return $next($request);
    }
}
