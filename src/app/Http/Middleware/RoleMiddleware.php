<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param $role
	 *
	 * @return mixed
	 */
    public function handle($request, Closure $next, $role)
    {
    	/*if ( auth()->user()->role_id !== (int) $role) {
    		abort(401, __("No puedes acceder a esta zona"));
	    }*/

        if (str_contains($role, '-')) {
            $role = explode('-',$role);
        }

        $found = false;
        foreach ($role as $role) {
            if (auth()->user()->role_id == (int) $role) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            return back()->with('error','No puedes acceder a esta zona');
        }

        return $next($request);
    }
}
