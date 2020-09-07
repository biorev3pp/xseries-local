<?php

namespace App\Http\Middleware;

use closure;
use Illuminate\Support\Facades\Auth;

class AdminRole
{

    public function handle($request, closure $next)
    {
        if (!in_array(Auth::user()->admin_role_id, [1,3])) {
            return redirect()->route('user_dashboard');
        }
        return $next($request);
    }
}
