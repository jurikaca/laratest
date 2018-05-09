<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class isAdmin
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
        $user = $request->user();
        if($user->role == User::ADMIN)
        {
            return $next($request);
        }
        notify()->flash('You have no access here', 'error');
        return back();
    }
}
