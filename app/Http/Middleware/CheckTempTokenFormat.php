<?php

namespace App\Http\Middleware;

use App\Rules\TempTokenExist;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckTempTokenFormat
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
            "temp_token.required" => ["code" => 3013, "message" => "temp_token is required"],
            "temp_token.regex" => ["code" => 3014, "message" => "temp_token is invalid"],

        ];

        $validator = Validator::make($request->all(), [
            "temp_token" => ["required", "regex:/^([a-f0-9]{64})$/u",new TempTokenExist()]
        ], $message);

        if ($validator->fails()) {

            $response = $validator->errors()->messages();

            return response($response["temp_token"][0]);
        }

        return $next($request);
    }
}
