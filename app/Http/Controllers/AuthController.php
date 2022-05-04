<?php

namespace App\Http\Controllers;

use App\Models\PersonalToken;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){

        $password_hashed=hash("sha256", $request->password);

        $user = User::where([
            ["email", "=", $request->email],
            ["password", "=", $password_hashed]
        ]);

        if ($user->count() == 0) {
            return response(["code" => 3018, "message" => "email and password is invalid"]);
        }

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
}
