<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckJobFreeze
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (moduleExists('SecurityManage')) {
            $user = Auth::guard('web')->user();

            if ($user && $user->freeze_job === 'freeze') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => __('Your campaign access has been frozen. Please contact support.'),
                    ], 403);
                }

                toastr_warning(__('Your campaign access has been frozen. Please contact support.'));
                return redirect()->route('client.dashboard');
            }
        }
        return $next($request);
    }
}
