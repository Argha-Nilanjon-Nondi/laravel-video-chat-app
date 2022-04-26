<?php

use App\Http\Controllers\SignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/signup",[SignUpController::class,"create_user"])->middleware(["check-email","check-username","check-password"]);
Route::post("/verifyotp", [SignUpController::class, "verify_otp"])->middleware(["check-otp-format","check-temp-token-format", "verify-temp-token-otp"]);