<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckOTPFormat
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
        $message = [
            "otp.required" => ["code" => 3010, "message" => "otp is required"],
            "otp.numeric" => ["code" => 3011, "message" => "otp is invalid"],
            "otp.min" => ["code" => 3012, "message" => "otp must be at least :min"],
        ];

        $validator = Validator::make($request->all(), [
            "otp" => ["required", "numeric","min:4",]
        ], $message);

        if ($validator->fails()) {

            $response = $validator->errors()->messages();

            return response($response["otp"][0]);
        }
        return $next($request);
    }
}
