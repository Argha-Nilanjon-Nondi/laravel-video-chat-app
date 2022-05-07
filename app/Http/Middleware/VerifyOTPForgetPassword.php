<?php

namespace App\Http\Middleware;

use App\Models\ForgetPassword;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VerifyOTPForgetPassword
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
        $required_minute = 30; //time for otp expiration
        $otp = $request->otp;
        $token = $request->token;
        $otp_hashed = hash("sha256", $otp);

        $emailVerify = ForgetPassword::select("updated_at")->where([
            ["otp", "=", $otp_hashed],
            ["token", "=", $token]
        ])->orderBy("updated_at", "desc");

        if ($emailVerify->count() == 0) {
            return response(["code" => 3016, "message" => "otp is not found"]);
        }

        $datetime = $emailVerify->take(1)->get();
        $datetime = $datetime[0]["updated_at"];


        $to = Carbon::parse($datetime);
        $from = Carbon::now();

        $diff_in_minutes = $to->diffInMinutes($from);

        if ($diff_in_minutes > $required_minute) {
            return response(["code" => 3017, "message" => "otp is not valid anymore"]);
        }
        return $next($request);
    }
}
