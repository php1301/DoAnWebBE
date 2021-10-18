<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminController;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {

            $user = Auth::user();
            if ($user->level == $role) {
                return $next($request);
            } else {
                return response('Tài khoản không đủ quyền!', 401);
            }
        } else {
            return response('Chưa đăng nhập!', 401);
        }
    }
}
