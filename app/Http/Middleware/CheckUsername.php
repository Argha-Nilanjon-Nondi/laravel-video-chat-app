<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\UsernameExist;

class CheckUsername
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
            "username.required" => ["code" => 3007, "message" => "username is required"],
            "username.regex" => ["code" => 3008, "message" => "username is invalid"],

        ];

        $validator = Validator::make($request->all(), [
            "username" => ["required", "regex:/(^([a-zA-z]+)(\d+)?$)/u", new UsernameExist()]
        ], $message);

        if ($validator->fails()) {

            $response = $validator->errors()->messages();

            return response($response["username"][0]);
        }
        return $next($request);
    }
}
