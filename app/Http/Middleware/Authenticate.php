<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }
            if( $guard === 'empresa' ){
                return redirect()->guest('empresa-login');
            }
            elseif($guard == 'admin')
            {
                return redirect()->guest('admin-login');
            }
            else{
                return redirect()->guest('embajador-login');
            }
            //return redirect()->guest('login');
        }

        return $next($request);
    }
}
