<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyEmailPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $password_hashed = hash("sha256", $request->password);
        
        $user = User::where([
            ["email", "=", $request->email],
            ["password", "=", $password_hashed]
        ]);

        if ($user->count() == 0) {
            return response(["code" => 3018, "message" => "email and password is invalid"]);
        }
        return $next($request);
    }
}
