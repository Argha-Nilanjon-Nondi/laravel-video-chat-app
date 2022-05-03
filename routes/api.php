<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/signup",[SignUpController::class,"create_user"])
->middleware([
    "check-email-format",
    "email-exist",
    "check-username-format",
    "username-exist",
    "check-password"
            ]);

            
Route::post("/otp/verify", [SignUpController::class, "verify_otp"])
->middleware([
    "check-otp-format",
    "check-token-format",
    "temp-token-exist", 
    "verify-temp-token-otp"
            ]);

Route::post("/otp/resend", [SignUpController::class, "resend_otp"])
->middleware([
    "check-token-format",
    "temp-token-exist",
]);

Route::post("/login", [AuthController::class, "login"])
->middleware([
    "check-email-format",
    "check-password"
]);