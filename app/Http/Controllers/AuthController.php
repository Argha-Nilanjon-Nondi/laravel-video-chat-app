<?php

namespace App\Http\Controllers;

use App\Models\PersonalToken;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendOTPMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ForgetPassword;

class AuthController extends Controller
{
    public function login(Request $request){

        $user = User::where([
            ["email", "=", $request->email]
        ]);
        
        $data=$user->get()[0];
        $userid=$data["userid"];
        $tokenid= random_int(1000000000, 99999999999);
        $token = random_int(1000, 9989898978999);
        $token_hashed = hash("sha256", $token);

        $tokendb=new PersonalToken();
        $tokendb->userid=$userid;
        $tokendb->tokenid=$tokenid;
        $tokendb->token=$token_hashed;
        $tokendb->save();

        return response(["code" => 2003, "message" => "login is successful","data"=>["token"=>$token_hashed]]);
    }

    public function send_reset_otp(Request $request){
        $email=$request->email;

        $otp = random_int(1000, 9999);
        $otp_hashed = hash("sha256", $otp);
        $token = random_int(1000, 9989898978999);
        $token_hashed = hash("sha256", $token);

        ForgetPassword::where("email", $email)->delete();

        $fpDB=new ForgetPassword();
        $fpDB->email=$email;
        $fpDB->otp=$otp_hashed;
        $fpDB->token=$token_hashed;
        $fpDB->save();


        $detail = ["otp" => $otp];
        Mail::to($email)->send(new SendOTPMail($detail));

        return response(["code"=>2004,"message"=> "otp for password reset is sent","data"=>["token"=>$token_hashed]]);
    }

    public function forget_password(Request $request){

        $token=$request->token;

        $password=$request->password;
        $password_hashed = hash("sha256", $password);

        $fpDB = ForgetPassword::where([
            ["token", "=", $token]
        ])->orderBy("updated_at", "desc");
        $email = $fpDB->get()[0]["email"];

        $user=User::where([["email","=",$email]]);
        $userid= $user->get()[0]["userid"];

        PersonalToken::where("userid", $userid)->delete();
        ForgetPassword::where("email", $email)->delete();

        $user->update(["password"=>$password_hashed]);

        return response(["code"=>2005,"message"=>"password is changed"]);
    }
}
