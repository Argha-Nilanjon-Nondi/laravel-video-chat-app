<?php

namespace App\Http\Controllers;

use App\Mail\SendOTPMail;
use App\Models\EmailVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function create_user(Request $request){
        
        $email=$request->email;
        $username=$request->username;
        $password=$request->password;
        $otp=random_int(1000,9999);
        $token = random_int(1000, 9989898978999);

        $otp_hashed =hash("sha256",$otp);
        $password_hashed=hash("sha256",$password);
        $token_hashed= hash("sha256", $token);
        $userid= random_int(1000000000, 99999999999);

        EmailVerify::where("email", $email)->delete();

        $emailVerify=new EmailVerify();
        $emailVerify->userid=$userid;
        $emailVerify->email=$email;
        $emailVerify->username=$username;
        $emailVerify->password=$password_hashed;
        $emailVerify->otp=$otp_hashed;
        $emailVerify->token=$token_hashed;

        $emailVerify->save();

        $data=[];
        $data["code"]=2000;
        $data["message"]="user is created , verify with otp code";
        $data["data"]=["token"=>str($token_hashed)];

        $detail=["otp"=>$otp];

        Mail::to($email)->send(new SendOTPMail($detail));
        return response($data);
    }

    public function verify_otp(Request $request){
        $otp=$request->otp;
        $token=$request->token;
        $otp_hashed = hash("sha256", $otp);

        $emailVerify = EmailVerify::select(["username","password","userid","email"])->where([
            ["otp", "=", $otp_hashed],
            ["token", "=", $token]
        ])->orderBy("updated_at", "desc");

        $data=$emailVerify->get()[0];

        $user= new User();
        $user->userid=$data["userid"];
        $user->email=$data["email"];
        $user->username=$data["username"];
        $user->password=$data["password"];
        $user->save();

        EmailVerify::where("email", $data["email"])->delete();

        return response(["code"=>2001,"message"=> "email is successfully verified"]);

    }

    public function resend_otp(Request $request){

        $token = random_int(1000, 9989898978999);
        $otp = random_int(1000, 9999);
        $token_hashed = hash("sha256", $token);
        $otp_hashed = hash("sha256", $otp);

        $emailVerify = EmailVerify::where("token", $request->token);
        $data = $emailVerify->get()[0];
        $email = $data["email"];
        $emailVerify->update(["token"=>$token_hashed,"otp"=>$otp_hashed]);

        $detail = ["otp" => $otp];

       
        Mail::to($email)->send(new SendOTPMail($detail));

        return response(["code"=>2002,"message"=>"otp is sent , verify your email","data"=>["token"=>$token_hashed]]);

    }
}
