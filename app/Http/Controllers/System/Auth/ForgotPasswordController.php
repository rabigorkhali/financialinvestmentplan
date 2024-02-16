<?php

namespace App\Http\Controllers\System\Auth;

use App\Exceptions\ResourceNotFoundException;
use App\Mail\system\ResendOtpEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\System\UserService;
use Illuminate\Support\Facades\Mail;
use App\Traits\CustomThrottleRequest;
use App\Mail\system\PasswordResetEmail;
use App\Exceptions\CustomGenericException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Config;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails, CustomThrottleRequest;

    public function __construct(private readonly UserService $user)
    {
    }

    public function showRequestForm()
    {
        $title = 'Forgot-password';
        return view('system.auth.forgotPassword', compact('title'));
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        try {
            if (
                method_exists($this, 'hasTooManyAttempts') &&
                $this->hasTooManyAttempts($request, Config::get('constants.DEFAULT_FORGOT_PASSWORD_LIMIT')) // maximum attempts can be set by passing parameter $attempts=
            ) {
                $this->customFireLockoutEvent($request);

                return $this->customLockoutResponse($request);
            }

            $this->incrementAttempts($request, Config::get('constants.DEFAULT_FORGOT_PASSWORD_EXPIRATION')); // maximum decay minute can be set by passing parameter $minutes=

            $this->sendPasswordResetLink($request->email);

            return back()->withErrors(['alert-success' => 'Password reset link has been sent to your email.']);

        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function sendPasswordResetLink($email)
    {
        $user = $this->user->findByEmail($email);
        $token = $this->user->generateToken(24);
        $encryptedToken = encrypt($token);
        $defaultLinkExpiration = Config::get('constants.DEFAULT_LINK_EXPIRATION'); //default link expiration in minutes

        $user->update([
            'token' => $token,
            'expiry_datetime' => now()->addMinutes($defaultLinkExpiration)->format('Y-m-d H:i:s')
        ]);

        Mail::to($user->email)->send(new PasswordResetEmail($user, $encryptedToken));
    }
}
