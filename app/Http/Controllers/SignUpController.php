<?php

namespace App\Http\Controllers;

use App\Mail\SendOTPMail;
use App\Models\EmailVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function create_user(Request $request){
        
        $email=$request->email;
        $username=$request->username;
        $password=$request->password;
        $otp=random_int(1000,9999);
        $temp_token = random_int(1000, 9989898978999);

        $otp_hashed =hash("sha256",$otp);
        $password_hashed=hash("sha256",$password);
        $temp_token_hashed= hash("sha256", $temp_token);
        $userid= random_int(1000000000, 99999999999);

        EmailVerify::where("email", $email)->delete();

        $emailVerify=new EmailVerify();
        $emailVerify->userid=$userid;
        $emailVerify->email=$email;
        $emailVerify->username=$username;
        $emailVerify->password=$password_hashed;
        $emailVerify->otp=$otp_hashed;
        $emailVerify->temp_token=$temp_token_hashed;

        $emailVerify->save();

        $data=[];
        $data["code"]=2000;
        $data["message"]="user is created , verify with otp code";
        $data["data"]=["temp_token"=>str($temp_token_hashed)];

        $detail=["otp"=>$otp];

        Mail::to($email)->send(new SendOTPMail($detail));
        return response($data);
    }

    public function verify_otp(Request $request){
        $otp=$request->otp;
        $temp_token=$request->temp_token;
        $otp_hashed = hash("sha256", $otp);

    }
}
