<?php

namespace App\Http\Middleware;

use App\Rules\EmailExist;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckEmail
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
        $message=[
            "email.required"=>["code"=>3001,"message"=>"email is required"],
            "email.email" => ["code" => 3002,"message" => "email address is invalid"],
           
        ];

        $validator=Validator::make($request->all(),[
            "email"=> ["required","email",new EmailExist()]
        ],$message);

        if ($validator->fails()){

            $response= $validator->errors()->messages();

            return response($response["email"][0]);
        }
        
        return $next($request);
    }
}
