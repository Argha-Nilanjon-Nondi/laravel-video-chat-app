<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckTokenFormat
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
            "token.required" => ["code" => 3013, "message" => "token is required"],
            "token.regex" => ["code" => 3014, "message" => "token is invalid"],

        ];

        $validator = Validator::make($request->all(), [
            "token" => ["required", "regex:/^([a-f0-9]{64})$/u"]
        ], $message);

        if ($validator->fails()) {

            $response = $validator->errors()->messages();

            return response($response["token"][0]);
        }

        return $next($request);
    }
}
