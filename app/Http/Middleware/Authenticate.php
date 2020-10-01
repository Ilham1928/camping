<?php

namespace App\Http\Middleware;

use Closure;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\AdminRolePermission;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = Session::get('admin_token');
        if (!empty($token)) {
            try {
                $decode = JWT::decode($token, env('JWT_SECRET'), array('HS256'));
                return $next($request);
            } catch (\Exception $e) {
                Session::forget('admin_token');
                return redirect('/');
            }

        }
        Session::forget('admin_token');
        return redirect('/');

    }
}
