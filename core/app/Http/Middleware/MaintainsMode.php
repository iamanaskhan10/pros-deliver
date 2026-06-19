<?php

namespace App\Http\Middleware;

use Closure;

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
        $maintenance = get_static_option('site_maintenance_mode', '');
        if ($maintenance === 'on') {
            return response()->view('frontend.pages.maintain');
        }
        return $next($request);
    }
}
