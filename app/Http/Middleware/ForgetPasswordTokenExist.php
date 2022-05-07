<?php

namespace App\Http\Middleware;

use App\Models\ForgetPassword;
use Closure;
use Illuminate\Http\Request;

class ForgetPasswordTokenExist
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
        $fpDB = ForgetPassword::where("token", $request->token);
        if ($fpDB->count() == 0) {
            return response(["code" => 3015, "message" => "token is not found"]);
        }
        return $next($request);
    }
}
