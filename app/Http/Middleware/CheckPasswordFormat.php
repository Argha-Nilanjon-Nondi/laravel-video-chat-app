<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckPasswordFormat
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
            "password.required" => ["code" => 3004, "message" => "password is required"],
            "password.regex" => ["code" => 3005, "message" => "password is invalid"],
            "password.min" => ["code" => 3006, "message" => "password must be at least :min"],
        ];

        $validator = Validator::make($request->all(), [
            "password" => ["required","min:8", "regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/",]
        ], $message);

        if ($validator->fails()) {

            $response = $validator->errors()->messages();

            return response($response["password"][0]);
        }

        return $next($request);
    }
}
