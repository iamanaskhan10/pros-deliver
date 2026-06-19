<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MaintainsMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Default ON when unset/null; only OFF when explicitly saved as '' in Basic Settings
        $maintenance = get_static_option('site_maintenance_mode');
        if ($maintenance !== '' && ! Auth::guard('admin')->check()) {
            return response()->view('frontend.pages.maintain');
        }
        return $next($request);
    }
}
