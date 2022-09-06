<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            if ($guard == 'admin') {
                return redirect('admin');
            }
            elseif ($guard == 'web') {
                return redirect()->route('viewLogin');
            }
            elseif($guard=='supplier')
            {
                return redirect('supplier/home');

            }
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
