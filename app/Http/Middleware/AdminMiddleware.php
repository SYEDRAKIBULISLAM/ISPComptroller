<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AdminMiddleware
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
        $admins = Admin::all();
        $isAdmin = false;
        foreach ($admins as $admin)
        {
            if (Auth::user()->id == $admin->user_id)
            {
                $isAdmin = true;
                break;
            }
        }
        if ($isAdmin == true)
        {
            return $next($request);
        }

        return redirect(URL::previous());
    }
}
