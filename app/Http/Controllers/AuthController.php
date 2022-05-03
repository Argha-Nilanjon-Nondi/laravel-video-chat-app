<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){

        $user = User::where([
            ["email", "=", $request->email],
            ["password", "=", $request->password]
        ]);

        $data = $user->get()[0];

        return response(["data" => $data]);

        if ($user->count() == 0) {
            return response(["code" => 3018, "message" => "email and password is invalid"]);
        }

        $data=$user->get()[0];

        return response(["data"=>$data]);
    }
}
