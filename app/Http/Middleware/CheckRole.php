<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckRole
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth::user();
        if ($user->role != 1) {
            Auth::logout();
            return redirect('/')->with('status', 'You are not allowed to access Admin Panel! ');
        }

        return $next($request);
    }

}