<?php

namespace App\Http;

use App\Http\Middleware\CheckEmail;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        "check-email-format"=>\App\Http\Middleware\CheckEmailFormat::class,
        "email-exist"=>\App\Http\Middleware\EmailExist::class,
        "check-username-format" => \App\Http\Middleware\CheckUsernameFormat::class,
        "username-exist"=>\App\Http\Middleware\UsernameExist::class,
        "check-password-format" => \App\Http\Middleware\CheckPasswordFormat::class,
        "check-otp-format"=>\App\Http\Middleware\CheckOTPFormat::class,
        "check-token-format"=>\App\Http\Middleware\CheckTokenFormat::class,
        "temp-token-exist"=>\App\Http\Middleware\TempTokenExist::class,
        "verify-temp-token-otp"=>\App\Http\Middleware\VerifyTempTokenOtp::class,
        "verify-email-password"=>\App\Http\Middleware\VerifyEmailPassword::class,
        "is-email-exist"=>\App\Http\Middleware\IsEmailExist::class,
        "verify-otp-forget-password"=>\App\Http\Middleware\VerifyOTPForgetPassword::class,
        "forget-password-token-exist"=>\App\Http\Middleware\ForgetPasswordTokenExist::class,
    ];
}
