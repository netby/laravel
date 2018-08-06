<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class SareaAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $auth = Auth::guard($guard);
        if (!$auth->guest()){
            if ($auth->user()->type!==9) {
                abort(404);
            }
        }else{
            abort(404);
        }

        return $next($request);
    }
}
