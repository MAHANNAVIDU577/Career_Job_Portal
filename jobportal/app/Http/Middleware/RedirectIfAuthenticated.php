<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guard): Response
    {
        $guard = empty($guard)? [null] : $guard;

        foreach ($guard as $guardName) {
            if (auth($guardName)->check()) {
                return redirect(route('account.profile'));
            }
        }
        return $next($request);
    }
}
