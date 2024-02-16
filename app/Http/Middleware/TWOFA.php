<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class TWOFA
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
        if (authUser()->is_2fa_enabled) {
            if (session()->get('verification_code', 'verifcation_code') == session()->get('request_verification_code')) {
                return $next($request);
            } else {
                return redirect('/'.getSystemPrefix().'/login/verify');
            }
        } else {
            return $next($request);
        }
    }
}
