<?php

namespace App\Http\Middleware;

use App\Enums\User\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== RoleEnum::ADMIN) {
            return redirect()->route('lockscreen');
        }

        return $next($request);
    }
}
