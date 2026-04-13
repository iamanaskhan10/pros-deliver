<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectFreeze
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

            if ($user && $user->freeze_project === 'freeze') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => __('Your project access has been frozen. Please contact support.'),
                    ], 403);
                }

                toastr_warning(__('Your project access has been frozen. Please contact support.'));
                return redirect()->route('influencer.dashboard');
            }
        }
        return $next($request);
    }
}
